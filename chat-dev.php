<?php

use app\assets\MainPageAsset;
use yii\web\View;

/* @var $this View */

?>
<?php MainPageAsset::register($this); ?>

<?php

$this->registerMetaTag([
	'name' => 'description',
	'content' => 'Chat dev ',
], 'description');

$this->registerMetaTag(['property' => 'og:title', 'content' => 'dev chat page']);

$this->registerCss(<<<CSS
    .someStyle {
        width: 100%;
    }
CSS);

?>

<h1>Chat page</h1>


<?php

$this->registerJs(<<<JS
    //this js code would be wrapped automatically $(document).ready(function () {})
    
    console.log("I'm ready");


JS, View::POS_READY);

?>
