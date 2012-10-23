<?php //netteCache[01]000400a:2:{s:4:"time";s:21:"0.48144600 1351023389";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:78:"/home/uiii/Pracoviste/Projekty/Kalendar/src/app/templates/Calendar.month.latte";i:2;i:1351023387;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:30:"6a33aa6 released on 2012-10-01";}}}?><?php

// source file: /home/uiii/Pracoviste/Projekty/Kalendar/src/app/templates/Calendar.month.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, '852xp61dwr')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb039563cc8b_content')) { function _lb039563cc8b_content($_l, $_args) { extract($_args)
?><div class="month">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new Nette\Iterators\CachingIterator($days) as $day): ?>
    <div class="day<?php if (($iterator->getCounter() - 1) % 7 == 0): ?> clear<?php endif ;if ($day['is-another-month']): ?>
 another-month-day<?php else: ?> current-month-day<?php endif ?>">
    <span class="day-numer"><?php echo Nette\Templating\Helpers::escapeHtml($day['number'], ENT_NOQUOTES) ?></span>
    <span class="day-name"><?php echo Nette\Templating\Helpers::escapeHtml($day['name'], ENT_NOQUOTES) ?></span>
    </div>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?></div>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 