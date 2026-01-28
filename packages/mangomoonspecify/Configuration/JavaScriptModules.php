<?php 


return [
   'dependencies' => ['backend'],
   'tags' => [
       'backend.form',
   ],
   'imports' => [
       '@mangomoon/mangomoonspecify/footnote.js' => 'EXT:mangomoonspecify/Resources/Public/Js/CKEditor/Footnote/src/footnote.js',
   ],
];