<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array($page["page_title"]);

?>

<h1>View Page #<?php echo $page["page_title"]; ?></h1>
<div id="container">
<?php echo $page["page_content"]; ?>
</div>

