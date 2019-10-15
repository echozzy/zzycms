// 上传图片
function uploadOneImage(inputId,module,dir='images'){
    var inpId = inputId+'-inp';
    var file_url_inp = $(inputId+'-file-url-inp');
    var file_path_inp = $(inputId+'-file-path-inp');
    var file_name_inp = $(inputId+'-file-name-inp');

    file_url_inp.val("");
    file_path_inp.val("");
    file_name_inp.val("");

    $(inputId+'-modal').modal('show');
    if(!$(inpId).hasClass('file-no-browse')){
        $(inpId).fileinput({
            language:'zh',                                          // 多语言设置，需要引入local中相应的js，例如locales/zh.js
            theme: "fas",                                           // 主题
            dropZoneTitle: '可以将图片拖放到这里<br>支持多文件上传<br><div tabindex="500" class="btn btn-primary btn-file"><i class="fas fa-folder-open"></i>  <span class="hidden-xs" >选择</span></div>',
            uploadUrl: '/files',                                   // 上传地址
            overwriteInitial: false,                                // 覆盖初始预览内容和标题设置
            showBrowse:false,
            showCancel:false,                                       // 显示取消按钮
            browseOnZoneClick:true,
            dropZoneClickTitle:'',
            showClose:false,
            showZoom:false,                                         // 显示预览按钮
            showUpload:false,                                       //是否显示上传按钮
            showCaption:false,                                      // 显示文件文本框
            dropZoneEnabled:true,                                   // 是否可拖拽
            uploadLabel:"上传",                                     // 上传按钮内容
            showRemove:false,                                       // 显示移除按钮
            maxFileCount:1,
            uploadExtraData: function(previewId, index) {           //该插件可以向您的服务器方法发送附加数据。这可以通过uploadExtraData在键值对中设置为关联数组对象来完成。所以如果你有设置uploadExtraData={id:'kv-1'}，在PHP中你可以读取这些数据$_POST['id']
                var obj = {};
                obj['module'] = module;
                obj['dir'] = dir;
                return obj;
            },   // 上传数据
            maxFileSize: 1024*10,
            allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg'],           //接收的文件后缀
            fileActionSettings: {                                   // 在预览窗口中为新选择的文件缩略图设置文件操作的对象配置
                showRemove: false,                                  // 显示删除按钮
                showUpload: false,                                  // 显示上传按钮
                showDownload: false,                                // 显示下载按钮
                showZoom: false,                                    // 显示预览按钮
                showDrag: false,                                    // 显示拖拽
                removeIcon: '<i class="fa fa-trash"></i>',          // 删除图标 
                uploadIcon: '<i class="fa fa-upload"></i>',         // 上传图标
                uploadRetryIcon: '<i class="fa fa-repeat"></i>'     // 重试图标
            },
    
        }).on('fileloaded', function () {//选中文件事件
            $(this).on('filebatchselected', function(){
                $(this).fileinput("upload");
            });
        }).on("fileuploaded", function(event, data, previewId) {
            var new_url = file_url_inp.val()+','+data.response.url;
            var new_path = file_path_inp.val()+','+data.response.file_path;
            var new_name = file_name_inp.val()+','+data.response.filename;

            file_url_inp.val(new_url);
            file_path_inp.val(new_path);
            file_name_inp.val(new_name);
            // 上传成功回调
            $(inpId).fileinput('lock').fileinput('disable');
            if(data.response.status){
                JsToast.fire({
                    type: 'success',
                    title: data.response.msg,
                })
            }else{
                JsToast.fire({
                    type: 'error',
                    title: data.response.msg,
                })
            }
        }).on('fileerror', function(event, data, msg) {
            // 上传失败回调
            JsToast.fire({
                type: 'error',
                title: data.msg,
            })
        });
    }
}

// 上传文件
function uploadFiles(inputId,module,dir='files'){
    var inpId = inputId+'-inp';
    var file_url_inp = $(inputId+'-file-url-inp');
    var file_path_inp = $(inputId+'-file-path-inp');
    var file_name_inp = $(inputId+'-file-name-inp');

    file_url_inp.val("");
    file_path_inp.val("");
    file_name_inp.val("");
    $(inputId+'-modal').modal('show');

    if(!$(inpId).hasClass('file-no-browse')){
        $(inpId).fileinput({
            language:'zh',                                          // 多语言设置，需要引入local中相应的js，例如locales/zh.js
            theme: "fas",                                           // 主题
            dropZoneTitle: '可以将文件拖放到这里<br>支持多文件上传<br><div tabindex="500" class="btn btn-primary btn-file"><i class="fas fa-folder-open"></i>  <span class="hidden-xs" >选择</span></div>',
            uploadUrl: '/files',                                   // 上传地址
            overwriteInitial: false,                                // 覆盖初始预览内容和标题设置
            showBrowse:false,
            showCancel:false,                                       // 显示取消按钮
            browseOnZoneClick:true,
            dropZoneClickTitle:'',
            showClose:false,
            showZoom:false,                                         // 显示预览按钮
            showUpload:false,                                       // 是否显示上传按钮
            showCaption:false,                                      // 显示文件文本框
            dropZoneEnabled:true,                                   // 是否可拖拽
            uploadLabel:"上传",                                     // 上传按钮内容
            showRemove:false,                                       // 显示移除按钮
            maxFileCount:5,                                         // 每次上传允许的最大文件数。如果设置为0，则表示允许的文件数是无限制的。默认为0
            uploadExtraData: function(previewId, index) {           // s该插件可以向您的服务器方法发送附加数据。这可以通过uploadExtraData在键值对中设置为关联数组对象来完成。所以如果你有设置uploadExtraData={id:'kv-1'}，在PHP中你可以读取这些数据$_POST['id']
                var obj = {};
                obj['module'] = module;
                obj['dir'] = dir;
                return obj;
            },   // 上传数据
            maxFileSize: 1024*50,
            // allowedFileExtensions: ['jpg', 'gif', 'png', 'jpeg'],   // 接收的文件后缀
            fileActionSettings: {                                   // 在预览窗口中为新选择的文件缩略图设置文件操作的对象配置
                showRemove: false,                                  // 显示删除按钮
                showUpload: false,                                  // 显示上传按钮
                showDownload: false,                                // 显示下载按钮
                showZoom: false,                                    // 显示预览按钮
                showDrag: false,                                    // 显示拖拽
                removeIcon: '<i class="fa fa-trash"></i>',          // 删除图标 
                uploadIcon: '<i class="fa fa-upload"></i>',         // 上传图标
                uploadRetryIcon: '<i class="fa fa-repeat"></i>'     // 重试图标
            },
    
        }).on('fileloaded', function () {
            // 文件加载完成
            $(this).on('filebatchselected', function(){
                //选中文件事件
                $(this).fileinput("upload");
            });
        }).on("fileuploaded", function(event, data, previewId) {
            var new_url = file_url_inp.val()+','+data.response.url;
            var new_path = file_path_inp.val()+','+data.response.file_path;
            var new_name = file_name_inp.val()+','+data.response.filename;
            file_url_inp.val(new_url);
            file_path_inp.val(new_path);
            file_name_inp.val(new_name);
        }).on('fileerror', function(event, data, msg) {
            // 上传失败回调
            JsToast.fire({
                type: 'error',
                title: data.msg,
            })
        });
    }
    
}

// 添加文件模版
function addFileHtml(inputId,file_url,file_name='') {
    var html =  '<li class="form-inline mb-2">'+
                '    <input type="hidden" class="form-control" name="files_url[]" value="'+file_url+'">'+
                '    <input type="text" class="form-control" name="files_name[]" value="'+file_name+'">'+
                '    <a class="ml-2" href="/'+file_url+'" target="_blank">下载</a>'+
                '    <a class="ml-2" href="javascript:;" onclick="removeFile(this)">删除</a>'+
                '</li>';
    return html;
}

// 删除文件
function removeFile(obj) {
    $(obj).parent().remove();
}

// 确认
function uploadConfirm(inputId) {
    var inpId = inputId+'-inp';
    $(inputId+'-modal').modal('hide');
    $(inpId).fileinput('clear');
    $(inpId).fileinput('unlock').fileinput('enable');

    if($(inputId+'-preview').length){
        // 图片上传
        if($(inputId+'-file-url').hasClass("active show")){
            $(inputId+'-preview').attr("src",$(inputId+'-file-url-content').val());
            $(inputId).val($(inputId+'-file-url-content').val());
        }else{
            // 获取已上传文件数据
            if($(inputId+'-file-url-inp').val()){
                var new_url = $(inputId+'-file-url-inp').val().substring(1).split(',');
                var new_path = $(inputId+'-file-path-inp').val().substring(1).split(',');
                var new_name = $(inputId+'-file-name-inp').val().substring(1).split(',');
            }
            if(new_url){
                $(inputId+'-preview').attr("src",new_url);
            }
            if(new_path){
                $(inputId).val(new_path);
            }
        }
    }else{
        // 文件上传
        var html = '';
        
        if($(inputId+'-file-url').hasClass("active show")){
            html = addFileHtml(inputId,$(inputId+'-file-url-content').val());
            $(inputId).append(html);
        }else{
            // 获取已上传文件数据
            if($(inputId+'-file-url-inp').val()){
                // var new_url = $(inputId+'-file-url-inp').val().substring(1).split(',');
                var new_path = $(inputId+'-file-path-inp').val().substring(1).split(',');
                var new_name = $(inputId+'-file-name-inp').val().substring(1).split(',');
            }
            $.each(new_path,function(index, item){
                html += addFileHtml(inputId,item,new_name[index]);
            });
            $(inputId).append(html);
        }
    }
}

// 取消
function uploadCancel(inputId) {
    var inpId = inputId+'-inp';
    $(inputId+'-modal').modal('hide');
    $(inpId).fileinput('clear');
    $(inpId).fileinput('unlock').fileinput('enable');
}