// 上传图片
function uploadOneImage(inputId,uploadUrl,data){
    var url = '';
    var inpId = inputId+'-inp'
    $(inputId+'-modal').modal('show');
    $(inpId).fileinput({
        language:'zh',                                          // 多语言设置，需要引入local中相应的js，例如locales/zh.js
        theme: "fas",                               // 主题
        dropZoneTitle: '可以将图片拖放到这里<br>支持多文件上传<br><div tabindex="500" class="btn btn-primary btn-file"><i class="fas fa-folder-open"></i>  <span class="hidden-xs" >选择</span></div>',
        uploadUrl: uploadUrl,         // 上传地址
        overwriteInitial: false,                        // 覆盖初始预览内容和标题设置
        showBrowse:false,
        showCancel:false,                                       // 显示取消按钮
        browseOnZoneClick:true,
        dropZoneClickTitle:'',
        showClose:false,
        showZoom:false,                                         // 显示预览按钮
        showUpload:false,                                     //是否显示上传按钮
        showCaption:false,                                  // 显示文件文本框
        dropZoneEnabled:true,                          // 是否可拖拽
        uploadLabel:"上传",                         // 上传按钮内容
        showRemove:false,                                       // 显示移除按钮
        maxFileCount:1,
        uploadExtraData: {'taskId':'taskId','createBy':'userId','createByname':'username'},   // 上传数据
        // uploadExtraData: data,   // 上传数据
        maxFileSize: 1024*10,
        fileActionSettings: {                               // 在预览窗口中为新选择的文件缩略图设置文件操作的对象配置
            showRemove: false,                                   // 显示删除按钮
            showUpload: false,                                   // 显示上传按钮
            showDownload: false,                            // 显示下载按钮
            showZoom: false,                                    // 显示预览按钮
            showDrag: false,                                        // 显示拖拽
            removeIcon: '<i class="fa fa-trash"></i>',   // 删除图标 
            uploadIcon: '<i class="fa fa-upload"></i>',     // 上传图标
            uploadRetryIcon: '<i class="fa fa-repeat"></i>'  // 重试图标
        },

    }).on('filebatchselected', function () {//选中文件事件
        $(this).fileinput("upload");
    }).on("fileuploaded", function(event, data, previewId) {
        url = data.response.url;
        // 上传成功回调
        $(inpId).fileinput('lock').fileinput('disable');
        JsToast.fire({
            type: 'success',
            title: '文件上传成功',
        })
    }).on('fileerror', function(event, data, msg) {
        // 上传失败回调
        JsToast.fire({
            type: 'error',
            title: data.msg,
        })
    });
    // 确认
    $(inputId+'-ok').click(function(){
        $(inputId+'-modal').modal('hide');
        $(inpId).fileinput('refresh');
        $(inpId).fileinput('unlock').fileinput('enable');
        $(inputId+'-preview').attr("src",url);
        $(inputId+'-preview').attr("src",url);
        $(inputId).val(url);
    });
    // 取消
    $(inputId+'-cancel').click(function(){
        $(inputId+'-modal').modal('hide');
        $(inpId).fileinput('refresh');
        $(inpId).fileinput('unlock').fileinput('enable');
    });
}