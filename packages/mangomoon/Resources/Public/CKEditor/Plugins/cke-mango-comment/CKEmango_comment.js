CKEDITOR.plugins.add( 'cke-mango-comment', {
  icons: 'comment',
  init: function( editor ) {
    editor.addCommand( 'wrapComment', {
      exec: function( editor ) {
        editor.insertHtml( '<span class="unsichtbar"' + editor.getSelection().getSelectedText() + '</span>' );
      }
    });
    editor.ui.addButton( 'cke-mango-comment', {
      label: 'Wrap comment',
      command: 'wrapComment',
      toolbar: 'insert'
    });
  }
});