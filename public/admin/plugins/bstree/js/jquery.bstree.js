/*
 *  Project:     bs-tree
 *  Description: The jQuery plugin Bstree enhances the display of a tree build of unordered lists with possibilities to
 *               open or close nodes, add icons and deal with data.
 *               If a data provider is supplied, dynamically-added three-state checkboxes can update these data feed a
 *               control with it.
 *               All generated html classes are modifiable. Chevron icons and label icons can be customized.
 *               It also possible to update nodes title dynamically and trigger an action when data is updated.
 *  Author:      Guillaume Limberger <glim.dev@gmail.com>
 *  License:     MIT
 *
 *
 *  HTML code example:
 *  <div id="mytree" class="bstree">
 *      <ul>
 *          <li data-id="PCA" data-level="1">
 *              <span>Provence-Alpes-Côte d'Azur</span>
 *              <ul>
 *                  <li data-id="PAC" data-level="2">
 *                       <span>Provence -Alpes- Côte d'Azur</span>
 *                  </li>
 *              </ul>
 *          </li>
 *      </ul>
 *  </div>
 *  <script>
 *      $("document").ready(function (){
 *          $('.bstree').each(function () {
 *              $(this).ifatree();
 *          });
 *      });
 *  </script>
 */

/*!
 The MIT License (MIT)

 Copyright (c) 2016-2017 Guillaume Limberger

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in all
 copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 SOFTWARE.
 */

;(function ($, window, document, undefined) {

  'use strict'

  var // plugin name
    pluginName = 'bstree',

    // key using in $.data()
    dataKey = 'plugin_' + pluginName,

    // create the defaults once
    defaults = {
      DEBUG: false,
      dataSource: '',                                      // 源代码管理ID
      initValues: '',
      dataSeparator: ':',                                     // 用于分解数据的分隔符
      chevronOpened: '<i class="far fa-caret-square-down fa-lg"></i>',    // 用于打开节点的图标
      chevronClosed: '<i class="far fa-caret-square-right fa-lg"></i>',   // 用于闭合节点的图标
      isExpanded: false,                                 // 设置节点是否最初展开
      nodeClass: pluginName + '-node',                      //  泛型节点类
      compositeClass: pluginName + '-composite',                 //  复合节点类
      leafClass: pluginName + '-leaf',                      //  叶节点类
      childrenClass: pluginName + '-children',                  //  节点子类
      innerContainerClass: pluginName + '-inner-container',
      chevronClass: pluginName + '-chevron',                   //  V形图标类
      labelClass: pluginName + '-label',                     //  标签类
      labelContainerClass: pluginName + '-label-container',
      iconClass: pluginName + '-icon',                      //  标签图标类
      expandedClass: pluginName + '-expanded',                  //  打开的节点类
      closedClass: pluginName + '-closed',                    //  闭节点类
      checkboxClass: pluginName + '-checkbox',                  //  复选框类
      incompleteClass: pluginName + '-incomplete',                //  不完整的节点类
      vLineClass: pluginName + '-vline',
      dataClass: pluginName + '-data',
      openTitle: 'Open',
      closeTitle: 'Close',
      checkboxTitle: 'Do action',
      updateNodeTitle: null,
      onDataPush: null
    }

  // The actual plugin constructor
  function Plugin (element, options) {
    this.element = element

    //jquery有一个extend方法，它将两个或
    //更多对象，将结果存储在第一个对象中。第一个对象
    //通常为空，因为我们不想更改
    //插件的未来实例
    this.settings = $.extend({}, defaults, options)
    this._defaults = defaults
    this._name = pluginName

    this._vItem = {
      setInitCount: function (node, settings) {
        var childrenCount = node.children('ul').children('li').length
        node.children('ul').children(settings._dotVLineClass).attr('data-vitems', childrenCount)
      },
      setCount: function (node, settings, vItem) {
        var count = vItem.getCount(node, settings)
        if (node.hasClass(settings.closedClass)) {
          count = -count
          node.find(settings._dotCompositeClass).each(function () {
            if ($(this).hasClass(settings.expandedClass) && $(this).is('li:last-child')) {
              count -= vItem.getCount($(this), settings)
            }
          })
        }
        else if (node.hasClass(settings.expandedClass)) {
          node.find(settings._dotCompositeClass).each(function () {
            if ($(this).hasClass(settings.expandedClass) && $(this).is('li:last-child')) {
              count += vItem.getCount($(this), settings)
            }
          })
        }
        if (settings.DEBUG) console.log('count = ' + count)
        node.parents(settings._dotCompositeClass).each(function (index) {
          var $this = $(this)
          var oldCount = vItem.getCount($this, settings)
          var newCount = oldCount + count
          if (index === 0 && node.is('li:last-child')) {
            newCount = oldCount
          }
          if (settings.DEBUG) console.log(index + ' : ' + newCount)
          $this.children('ul').children(settings._dotVLineClass).attr('data-vitems', newCount)
          // vItem.setHeight($this, settings, vItem)
        })
      },
      getCount: function (node, settings) {
        var nb = node.children('ul').children(settings._dotVLineClass).attr('data-vitems')
        if (undefined === nb) { return -1 }
        return parseInt(nb)
      },
      setHeight: function (node, settings, vItem) {
        var count = vItem.getCount(node, settings)
        var height = 0
        if (element.hasClass(settings.dataClass)) {
          height = (count - 1) * settings._datavItemHeight + settings._datavLineOffset
        }
        else {
          height = (count - 1) * settings._vItemHeight + settings._vLineOffset
        }
        node.children('ul').children(settings._dotVLineClass).css('height', height)
      }
    }

    // 打开节点并设置关联的图标
    this.element.openNode = function (node, settings) {
      node.children('ul').show()
      node.addClass(settings.expandedClass).removeClass(settings.closedClass)
      node.children('div').children(settings._dotChevronClass)
        .html(settings.chevronOpened + '&nbsp;')
        .attr('title', settings.closeTitle)
    }

    // 关闭节点并设置关联的图标
    this.element.closeNode = function (node, settings) {
      node.children('ul').hide()
      node.addClass(settings.closedClass).removeClass(settings.expandedClass)
      node.children('div').children(settings._dotChevronClass)
        .html(settings.chevronClosed + '&nbsp;')
        .attr('title', settings.openTitle)
    }

    // 用数据管理树
    this._data = {}
    if (this.settings.dataSource.length) { // a source of data is provided

      this._data = {

        // 连接/拆分源数据的分隔符
        separator: this.settings.dataSeparator,

        // 数据源（jquery对象）
        source: this.settings.dataSource,

        // 源的初始值
        initValues: this.settings.initValues.split(this.settings.dataSeparator),

        // 存储值
        values: this.settings.dataSource.val().split(this.settings.dataSeparator),

        /** 将数据推送到源 */
        push: function (settings) {
          this.source.val(this.values.join(this.separator))
          if (typeof settings.onDataPush === 'function') {
            settings.onDataPush(this.values)
          }
        },

        /** 将数据推送到源 */
        pull: function () {
          this.values = this.source.val().split(this.separator)
        },

        /** 删除节点元素及其子元素的“不完整”类 */
        resetIndeterminate: function (node, settings) {
          node.removeClass(settings.incompleteClass)
          node.find(settings._dotCompositeClass).removeClass(settings.incompleteClass)
          node.children('.checkbox').find(settings._dotCheckboxClass)
            .prop('indeterminate', false)
          node.find(settings._dotCompositeClass)
            .children('.checkbox').find(settings._dotCheckboxClass)
            .prop('indeterminate', false)
        },

        /** 将复选框状态传播到子级 */
        propagateToChildren: function (node, state, settings) {
          node.find(settings._dotCheckboxClass).prop('checked', state)
        },

        /** 将复选框状态传播到祖先 */
        propagateToParent: function (node, settings) {
          node.parents(settings._dotNodeClass).each(function () {
            var $node = $(this)
            var check = 0
            if ($node.children(settings._dotInnerContainerClass).find(settings._dotCheckboxClass).prop('checked')) {
              check++
            }

            // 获取节点兄弟节点以计算复选框计数
            var $siblings = $node.siblings('li') // the calling node is not in the sibling collection
            var checkCount = $siblings.length + 1 // + 1 for the calling node
            $.each($siblings, function (index, sibling) {
              var $sibling = $(sibling)
              // “节点”复选框
              var $checkbox = $sibling.children(settings._dotInnerContainerClass).find(settings._dotCheckboxClass)
              if ($checkbox.prop('checked')) { check++ }
            })
            if (settings.DEBUG) console.log($node.data('level') + ' check = ' + check + '/' + checkCount)

            // 确定父节点的行为
            var $parentNode = $node.parent('ul').parent('li')
            if ($parentNode.length) {
              // “节点”复选框
              var $checkbox = $parentNode.children(settings._dotInnerContainerClass).find(settings._dotCheckboxClass)

              if (check === checkCount) { // 检查所有兄弟姐妹
                $checkbox.prop('indeterminate', false).prop('checked', true)
              }
              else if (check === 0) { // 没有检查兄弟姐妹
                $checkbox.prop('indeterminate', false).prop('checked', false)
                // 验证是否选中了子复选框
                if ($parentNode.find('input:checked').length) {
                  $checkbox.prop('indeterminate', true)
                }
              } else { // 一些兄弟姐妹被检查
                $checkbox.prop('indeterminate', true).prop('checked', false)
              }
            }
          })
        },

        /** 从叶节点收集数据复选框 */
        getLeafData: function (settings) {
          var newValues = []
          element.find(settings._dotCheckboxClass).each(function () {
            var $node = $(this).closest(settings._dotLeafClass)
            if ($(this).prop('checked') && $node.length) {
              var pid = $node.data('id')
              newValues.push(pid)
            }
          })
          this.values = newValues
        }
      }
    }

    this.init()
  }

  // 避免plugin.prototype冲突
  $.extend(Plugin.prototype, {
    init: function () {
      var
        element = this.element,
        settings = this.settings,
        vItem = this._vItem,
        data = this._data

      if (element.length === 0) {
        throw pluginName + ' - the element is not valid.'
      }

      // 内部设置
      settings._dotNodeClass = '.' + settings.nodeClass
      settings._dotCompositeClass = '.' + settings.compositeClass
      settings._dotLeafClass = '.' + settings.leafClass
      settings._dotChildrenClass = '.' + settings.childrenClass
      settings._dotChevronClass = '.' + settings.chevronClass
      settings._dotExpandedClass = '.' + settings.expandedClass
      settings._dotCheckboxClass = '.' + settings.checkboxClass
      settings._dotLabelClass = '.' + settings.labelClass
      settings._dotIconClass = '.' + settings.iconClass
      settings._dotVLineClass = '.' + settings.vLineClass
      settings._vLineOffset = 12
      settings._datavLineOffset = 12
      settings._vItemHeight = 32
      settings._datavItemHeight = 32
      settings._dotLabelContainerClass = '.' + settings.labelContainerClass
      settings._dotInnerContainerClass = '.' + settings.innerContainerClass

      // 向li元素添加类
      element.find('li').each(function () {
        var $this = $(this)
        if ($this.has('ul').length) {
          $this.addClass(settings.nodeClass + ' ' + settings.compositeClass)
        } else {
          $this.addClass(settings.nodeClass + ' ' + settings.leafClass)
        }
      })

      // 向ul元素添加类（除了最上面的元素）
      element.children('ul').find('ul')
        .addClass(settings.childrenClass)
        .prepend('<i class="' + settings.vLineClass + '"></i>')

      // 将类添加到标签并包装它们
      element.find('li > span').addClass(settings.labelClass)
        .wrap('<div class="' + settings.innerContainerClass + '"></div>').wrap('<label class="' + settings.labelContainerClass + '"></label>')
      // 添加标签图标和V形图标
      element.find(settings._dotLabelClass)
        .before('<span class="' + settings.iconClass + '"></span>')
        .parent('label')
        .before('<span class="' + settings.chevronClass + '"></span>')

      // 更新节点标题
      element.find(settings._dotNodeClass).each(function () {
        if (typeof settings.updateNodeTitle === 'function') {
          var $node = $(this)
          var $label = $node.children('div').find(settings._dotLabelClass)
          $label.html(settings.updateNodeTitle($node, $label.text()))
        }
      })

      // 根据设置初始打开/关闭节点
      element.find(settings._dotCompositeClass).each(function () {
        if (settings.isExpanded) {
          element.openNode($(this), settings)
        }
        else {
          element.closeNode($(this), settings)
          vItem.setInitCount($(this), settings)
        }
      })

      /**
       * 在V形元素上单击事件
       */
      element.find(settings._dotChevronClass).click(function () {
        var $node = $(this).closest(settings._dotCompositeClass)
        if ($node.hasClass(settings.closedClass)) {
          element.openNode($node, settings)
        } else if ($node.hasClass(settings.expandedClass)) {
          element.closeNode($node, settings)
        }
        vItem.setCount($node, settings, vItem)
      })

      /* init tree with data */
      if (!$.isEmptyObject(data)) { // available data
        // adding has-data class to element
        element.addClass(settings.dataClass)

        // adding checkbox elements
        // element.find(settings._dotLabelClass).addClass('custom-control-description');

        // add checkboxes
        element.find(settings._dotNodeClass).each(function (index, el) {
          var id = $(el).data('id')

          $(el).find('label').first()
            .attr('for', settings.checkboxClass + '-' + id)
            .addClass('custom-control-label')
            .wrap('<div class="custom-control custom-checkbox" style="display: inline-block"></div>')

          $(el)
            .find('.custom-control.custom-checkbox').first()
            .prepend('<input id="' + settings.checkboxClass + '-' + id + '" type="checkbox" class="custom-control-input ' + settings.checkboxClass + '" title="' + settings.checkboxTitle + '">')
        })

        // pulling data from the bound control
        data.pull()

        /**
         * Change event on checkbox elements
         */
        element.find(settings._dotCheckboxClass).change(function () {
          var $this = $(this)

          if ($this.closest(settings._dotLeafClass).length === 0) { // checkbox of composite node
            var $node = $(this).closest(settings._dotNodeClass)
            data.resetIndeterminate($node, settings)
            if ($this.prop('checked')) {
              data.propagateToChildren($node, true, settings)
            } else {
              data.propagateToChildren($node, false, settings)
            }
          }
          // process parent nodes
          data.propagateToParent($this, settings)
          // get data from leaf nodes
          data.getLeafData(settings)
          // push data to source
          data.push(settings)
        })

        for (var i = 0; i < data.initValues.length; i++) {
          element.find(settings._dotNodeClass).each(function () {
            var id = $(this).data('id')
            if (id === data.initValues[i]) {
              data.propagateToChildren($(this), true, settings)
              $(this).find(settings._dotCheckboxClass).change()
            }
          })
        }
      }
    }
  })

  // A really lightweight plugin wrapper around the constructor,
  // preventing against multiple instantiations
  $.fn[pluginName] = function (options) {
    var plugin = this.data(dataKey)

    // has plugin instantiated ?
    if (plugin instanceof Plugin) {
      // if have options arguments, call plugin.init() again
      if (typeof options !== 'undefined') {
        plugin.init(options)
      }
    } else {
      plugin = new Plugin(this, options)
      this.data(dataKey, plugin)
    }

    return plugin
  }

})(jQuery, window, document)
