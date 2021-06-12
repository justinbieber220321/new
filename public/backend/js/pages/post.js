$(document).ready(function () {
    PostController.init();
});

var PostController = {
    init: function () {
        PostController.handelQuillEditor();
    },

    handelQuillEditor() {
        if (selectorIsExits("#editor-quill")) {
            var quillValue = $('input[name=content]').val();
            var quill = new Quill('#editor-quill', {
                modules: {
                    toolbar: [
                        ['bold', 'italic'],
                        ['link', 'blockquote', 'code-block', 'image'],
                        [{ list: 'ordered' }, { list: 'bullet' }]
                    ]
                },
                placeholder: 'Enter content',
                theme: 'snow'
            });
            quill.root.innerHTML = quillValue;

            $(".store-update-entity").submit(function(  ) {
                let input = $('#editor-quill').parent().children('input[type="hidden"]');
                input.val(quill.root.innerHTML.trim());
                return true; // submit form
            });
        }
    }
};
