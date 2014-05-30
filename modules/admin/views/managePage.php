<?php
/**
 * Parsimony
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@parsimony-cms.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Parsimony to newer
 * versions in the future. If you wish to customize Parsimony for your
 * needs please refer to http://www.parsimony.mobi for more information.
 *
 * @authors Julien Gras et Benoît Lorillot
 * @copyright Julien Gras et Benoît Lorillot
 * 
 * @category Parsimony
 * @package admin
 * @license    http://opensource.org/licenses/osl-3.0.php 
 *  Open Software License (OSL 3.0)
 */
?>
<script src="<?php echo BASE_PATH; ?>lib/jquery-ui/jquery-ui-1.10.3.min.js"></script>
<style>
	.showcomponent{position: relative;background: #FAFAFA;height: 156px;text-align: center;padding: 5px 0;overflow-x: auto;overflow-y: hidden;color: #444;} 
	.showcomponent input{border-style: none;padding: 4px;outline: none;color: #333;border-radius: 1px;
width: 130px;background-color: #fafafa;margin: 0 10px;}
	.showcomponent .type{margin: 5px 10px;cursor: move;}
	.paramstatique, .paramdyn{float: left;margin: 0px 5px;position: relative;box-shadow: 1px 1px 1px #E7E7E7;font-weight: bold;background: #FEFEFE;}
	.paramstatique .text,.parsiname{border-bottom: 3px solid #2DC1EE;}
	#tabs-admin-query{position:relative;text-align: left}
	.modulecss{padding: 5px;list-style: none;border: 1px solid #C8CBCF;background-color: #ECECEC;text-transform: capitalize;}
	.modulecss a{text-decoration: none;color:#333;}
	.details{display:none;position:absolute;top:18px;z-index:1;background: #fff;width: 650px;border: 1px solid #C5C6C9;padding: 3px;overflow-x: scroll}
	.detailsCont{width: 1500px;}
	.entity{border-radius: 3px;box-shadow: #666 0px 1px 3px;background: #FBFBFB;margin:2px 2px;}
	.cent{width:100%;box-sizing:border-box;}
	.entityname{font-weight: bold;font-size: 12px;padding:5px 4px;color: white;background: #1b74a4;border-top-left-radius: 3px;border-top-right-radius: 3px;text-align: center;}
	.property{padding: 0 5px;cursor: pointer;line-height: 16px;font-family: sans-serif;font-size: 11px;border-bottom: dotted #ddd 1px;font-weight: normal;}
	.property:hover{background:#CBDDF3}
	#recipiant_sql select{margin-bottom: 5px;margin-top: 5px;}
	.choicebuilder{display: inline-block;position:relative;vertical-align: top;width: 225px;margin: 8px;padding: 7px;padding-top: 40px;background: #fafafa;color: black;height: 110px;}
	.choicetitle{font-size: 15px;text-align: left;background-color: #F1F1F1;border-left: 3px solid #2DC1EE;line-height: 25px;
color: #494747;padding-left: 11px;position: absolute;top: 0;left: 0;right: 0;}
	.parsiplusone {display: inline-block;vertical-align: top;
				   background: url("<?php echo BASE_PATH; ?>admin/img/add.png") no-repeat;width: 16px;height: 16px;}
	#col > div,.paramdyn > div,.paramstatique > div{line-height:30px;text-align:left;}
	#col > div{line-height: 32px;padding-left: 5px;border-bottom: #EFEFEF 1px solid;letter-spacing: 1.2px;}
	#col{max-width: 120px;float: left;margin-right: 5px;}
	#addparam {margin-top: 10px;}
	#container{width:10000px}
	.ui-state-highlight{border:#ccc 61px solid;float:left;height:52px;}
	#container .ui-icon-closethick{position: absolute;top: 6px;right: 11px;display: none}
	#container > div:hover .ui-icon-closethick{display:block}
	.robots{margin: 1px 0;border : 1px solid #f0f0f0;}
	.robots tr{background: white;}
	.robots td{padding: 5px 2px 5px 15px;color: #444;font-size: 12px;text-align: left !important;line-height: 22px;}
	.robots .opt{padding: 5px 2px 5px 15px;text-align: center !important;}
	.disabled{pointer-events: none;opacity:0.8}
	#tabs-admin-querieur{border: 1px solid #EEEBEB;padding-top: 10px;}
	#tabs-admin-query{padding: 10px;}
	#titlebuilder{display: inline-block;text-transform: capitalize;
color: #FFF;padding: 3px 7px;font-size: 14px;background-color: #2DC1EE;border-left: 3px solid #2DC1EE;}
	.adminzonecontent{left:0;padding: 3px 15px;}
	.adminzone .btn {margin: 5px 10px;}
	.adminzone .save {margin-left: 10px;}
	#paramname{width: 120px;margin-right: 10px;}
	#regenerate{position: absolute;
left: 522px;
top: 32px;
z-index: 1;}
</style>

<div class="adminzone" id="adminformpage">
	<?php if(stream_resolve_include_path($module->getName() . '/pages/' . $page->getId() . '.obj') === FALSE): ?>
	<style>.notNew{visibility: hidden}</style>
	<div id="conf_box_title"><?php echo t('Add a page in').' '.$module->getName() ?></div>
	<?php else: ?>
	<div id="conf_box_title"><?php echo t('Manage this page') ?></div>
	<?php endif; ?>
	<div id="contentformpage"  class="adminzonecontent">
		<form class="form" target="formResult" method="POST">
			<input type="hidden" name="TOKEN" value="<?php echo TOKEN; ?>" />
			<input type="hidden" name="id_page" value="<?php echo $page->getId(); ?>">
			<input type="hidden" name="action" value="savePage">
			<div class="tabs">
				<ul>
					<li class="active"><a href="#tabs-1"><?php echo t('URL & Rewriting'); ?></a></li>
					<li><a href="#tabs-2"><?php echo t('SEO'); ?></a></li>
					<?php if ($_SESSION['permissions'] & 32): /* perm 32 = choose a theme */ ?>
						<li><a href="#tabs-3"><?php echo t('Theme'); ?></a></li>
					<?php endif; ?>
				</ul>
				<div class="clearboth" style="padding-top: 10px;"></div>
				<div id="tabs-1" class="panel">
					<?php echo '<input type="hidden" name="module" value="' . s($module->getName()) . '">'; ?>
					<div class="placeholder">
						<label for="title"><?php echo t('Title'); ?></label><input type="text" name="title" style="width:95%;" value="<?php echo s($page->getTitle()); ?>">
					</div>
					<div style="position: relative">
					<svg id="regenerate" width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#333333"><g><path d="M 6,0 C 2.733,0 0.077,2.61 0.002,5.859 C 0.071,3.025 2.226,0.75 4.875,0.75 C 7.567,0.75 9.75,3.101 9.75,6 C 9.75,6.621 10.254,7.125 10.875,7.125 C 11.496,7.125 12,6.621 12,6 C 12,2.686 9.314,0 6,0 ZM 6,12 C 9.267,12 11.923,9.39 11.998,6.141 C 11.929,8.975 9.774,11.25 7.125,11.25 C 4.433,11.25 2.25,8.899 2.25,6 C 2.25,5.379 1.746,4.875 1.125,4.875 C 0.504,4.875 0,5.379 0,6 C 0,9.314 2.686,12 6,12 Z"></path></g></svg>
					<div class="placeholder inputregex" style="display: inline-block">
						<label for="title"><?php echo t('URL'); ?></label><input type="text" id="patternurlregex" name="regex" style="width:540px;" value="<?php echo s(substr($page->getRegex(), 2, -2)); ?>">
					</div>
					</div>
					<div style="top: 5px;position: relative;left: 7px;text-overflow:ellipsis;font-size:13px">
						<span for="genereURL"><?php echo t('URL'); ?> : </span><span id="totalurl">http://<?php echo $_SERVER['HTTP_HOST'] . BASE_PATH ?><span class="modulename"><?php
								$modulename = $module->getName();
								if ($modulename != \app::$config['defaultModule'])
									echo $modulename;
								?></span><?php if ($modulename != \app::$config['defaultModule']) echo '/'; ?><span id="patternurl" ><?php echo $page->getURL(); ?></span></span>
					</div>
					<?php if ($_SESSION['permissions'] & 8): ?>
						<div style="position: absolute;left: 570px;top: 82px;cursor:pointer;color: #333;line-height: 15px;" onclick="$('#tabs-admin-querieur').toggle();">
							<span style="position: relative;top: 0px;right: 4px;" class="parsiplusone"></span><?php echo t('Dynamic page'); ?>
						</div>
					<?php endif; ?>
					<div id="pageOverride" style="position: relative;top: 16px;left: 7px;"></div>
					<div style="position:relative;padding-top: 30px;">
					<?php if ($_SESSION['permissions'] & 8): ?>
						<?php $components = $page->getURLcomponents(); ?>
							<div id="tabs-admin-querieur" class="none">
								<div id="tabs-admin-query">
									<div id="titlebuilder"><?php echo t('URL Builder'); ?></div>
									<div class="showcomponent <?php if (empty($components)) echo 'none'; ?>">
										<div id="col">
											<div><?php echo t('Name'); ?></div>
											<div><?php echo t('Component'); ?></div>
											<div><?php echo t('Regex'); ?></div>
											<div><?php echo t('Default Value'); ?></div>
										</div> 
										<div id="abc" class="none paramdyn">
											<div class="parsiname"><input type="text"></div>
											<div class="type"><?php echo t('Regex'); ?></div>
											<div class="regex"><input type="text"></div>
											<div class="modelProperty" style="display:none"><input type="hidden"></div>
											<div class="val"><input type="text"></div>
											<a href="" class="ui-icon ui-icon-closethick" onClick="if (confirm('<?php echo t('Are you sure to delete this component ?'); ?>'))$(this).parent().remove();genereregex();return false;"></a>
										</div>
										<div id="abcd" class="none paramstatique">
											<div class="text"><input type="text"></div>
											<div class="type" style="height: 90px;"><?php echo t('Text'); ?></div>
											<a href="" class="ui-icon ui-icon-closethick" onClick="if (confirm('<?php echo t('Are you sure to delete this component ?'); ?>'))$(this).parent().remove();return false;"></a>
										</div>
										<div id="container">
											<?php
											if (!empty($components)) {
												foreach ($page->getURLcomponents() AS $idc => $component) {
													if (isset($component['regex'])) {
														?>
														<div class="paramdyn">
															<div class="parsiname"><input value="<?php echo $component['name']; ?>" name="URLcomponents[<?php echo $idc; ?>][name]" type="text" ></div>
															<div class="type"><?php echo t('Regex'); ?></div>
															<div class="regex"><input value="<?php echo $component['regex']; ?>" name="URLcomponents[<?php echo $idc; ?>][regex]" type="text" ></div>
															<div class="modelProperty" style="display:none"><input value="<?php if (isset($component['modelProperty'])) echo $component['modelProperty']; ?>" name="URLcomponents[<?php echo $idc; ?>][modelProperty]" type="hidden"></div>
															<div class="val"><input value="<?php echo $component['val']; ?>" name="URLcomponents[<?php echo $idc; ?>][val]" type="text"></div>
															<a href="" class="ui-icon ui-icon-closethick" onClick="if(confirm('<?php echo t('Are you sure to delete this component ?'); ?>'))$(this).parent().remove();genereregex();return false;"></a>
														</div>
														<?php
													} else {
														?>
														<div class="paramstatique">
															<div class="text"><input type="text" class="cent" name="URLcomponents[<?php echo $idc ?>][text]" value="<?php echo $component['text'] ?>"></div>
															<div class="type" style="height: 90px;"><?php echo t('Text'); ?></div>
															<a href="" class="ui-icon ui-icon-closethick" onClick="if (confirm('<?php echo t('Are you sure to delete this component ?'); ?>'))$(this).parent().remove();genereregex();return false;"></a>
														</div>
													<?php
												}
											}
										}
										?>
										</div>
									</div>
									<div style="clear: both;padding-top: 15px;"><?php echo t('To create your URL, Choose between these elements'); ?></div>
									<div id="schema_sql" class="choicebuilder" style="width: 175px;">
										<div class="choicetitle"><?php echo t('A SQL property'); ?></div>
										<?php
										foreach (\app::$activeModules as $moduleName => $type) {
											$module = app::getModule($moduleName);
											$models = $module->getModel();
											$allowedField = array('field_ident' => '1', 'field_string' => 'example', 'field_numeric' => '1', 'field_numeric' => '1', 'field_url_rewriting' => 'example', 'field_user' => '1');
											$aliasClasses = array_flip(\app::$aliasClasses);
											if (count($models) > 0) {
												echo '<div class="floatleft ui-tabs-nav" style="position:relative;">
												<li class="ui-state-default ui-corner-top modulecss">' . $module->getName() . '</li><div class="details"><div class="detailsCont">';
												foreach ($models as $modelName => $model) {
													echo '<div class="inline-block entity" table="' . $module->getName() . '_' . $modelName . '">
									<div class="table entityname ellipsis">' . $module->getName() . '_' . $modelName . '</div>';
													$obj = $module->getEntity($modelName);
													foreach ($obj->getFields() AS $field) {
														$className = get_class($field);
														if (isset($allowedField[$aliasClasses[$className]])) {
															/* remove ^ and $ for regex to allow multiple composant in general regex */
															echo '<div name="' . $field->name . '" regex="(' . str_replace('^', '', str_replace('$', '', $field->regex)) . ')" val="'.$allowedField[$aliasClasses[$className]].'" class="ellipsis property ' . $className . '">' . $field->name . '</div>';
														}
													}
													echo '</div>';
												}
												echo '</div></div></div>';
											}
										}
										?>
										<div class="clearboth"></div>
									</div>
									<div class="choicebuilder">
										<div class="choicetitle"><?php echo t('A regex parameter'); ?></div>
										<input type="text" id="paramname">
										<select id="paramregex"><option value="(.*)"></span><?php echo t('Text'); ?></option><option value="([0-9]*)"></span><?php echo t('Numeric'); ?></option></select>
										<input type="button" id="addparam" value="<?php echo t('Add Text Component'); ?>">
									</div>
									<div class="choicebuilder">
										<div class="choicetitle"><?php echo t('A simple textual parameter'); ?></div>
										<input type="button" id="addtextcomposant" value="<?php echo t('Add Text Component'); ?>">
									</div>
								</div>
								<div class="none"><a href="#" onClick="$('input[name=\'regex\']');return false;"><?php echo t('Dynamise your page with numbers'); ?></a> <a href="#" onClick="$(this).next().slideToggle();return false;"><?php echo t('Dynamise your page with String'); ?></a></div>
								<div class="clearboth"></div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				
				<div id="tabs-2" class="fields_to_update panel none">
					<div class="placeholder">
						<label for="meta[description]"><?php echo t('Description'); ?></label>
						<textarea class="cent" name="meta[description]" row="7" cols="50"><?php echo s($page->getMeta('description')); ?></textarea>
					</div>
					<div class="placeholder">
						<label for="meta[keywords]"><?php echo t('Keywords'); ?></label>
						<textarea class="cent" name="meta[keywords]" row="7" cols="50"><?php echo s($page->getMeta('keywords')); ?></textarea>
					</div>
					<div class="placeholder">
						<label for="meta[author]"><?php echo t('Author'); ?></label>
						<textarea class="cent" name="meta[author]" row="7" cols="50"><?php echo s($page->getMeta('author')); ?></textarea>
					</div>
					<div class="placeholder">
						<label><?php echo t('Robots'); ?></label>
						<input type="hidden" name="meta[robots]" id="SEOrobots" value="<?php echo s($page->getMeta('robots')); ?>" /><br><br>
						<table class="robots">
							<tbody>
							<tr>
								<td><?php echo t('No index'); ?></td><td class="opt"><input type="checkbox" class="robotsOptions" data-option="noindex" <?php if (strstr($page->getMeta('robots'), 'noindex')) echo ' checked="checked"'; ?> /></td>
							</tr>
							<tr>
								<td><?php echo t('No follow'); ?></td><td class="opt"><input type="checkbox" class="robotsOptions" data-option="nofollow" <?php if (strstr($page->getMeta('robots'), 'nofollow')) echo ' checked="checked"'; ?> /></td>
							</tr>
							<tr>
								<td><?php echo t('No archive'); ?></td><td class="opt"><input type="checkbox" class="robotsOptions" data-option="noarchive" <?php if (strstr($page->getMeta('robots'), 'noarchive')) echo ' checked="checked"'; ?> /></td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<?php if ($_SESSION['permissions'] & 32): /* perm 32 = choose a theme */ ?>
					<div id="tabs-3" class="panel none">
						<div class="placeholder">
							<label for="theme"><?php echo t('Theme'); ?></label>
							<select name="theme">
								<option value="">Default</option>
								<?php
								$theme = $page->getTheme();
								$currentTheme = FALSE;
								if ($theme instanceof theme) {
									$currentTheme = $theme->getModule() . '_' . $theme->getName();
									if ($currentTheme === \app::$config['THEMEMODULE'] . '_' . \app::$config['THEME']) {
										$currentTheme = '';
									}
								}
								$modules = \app::$activeModules;
								foreach ($modules as $moduleName => $mode) {
									$module = \app::getModule($moduleName);
									foreach ($module->getThemes() as $themeName) {
										$name = $moduleName . '_' . $themeName;
										echo '<option value="' . $name . '"' . ($currentTheme === $name ? ' selected="selected"' : '') . '>' . $themeName . ' (' . $moduleName . ')</option>';
									}
								}
								?>
							</select>
						</div>
					</div>
				<?php endif; ?>
				<input class="none" type="submit" id="sendFormPage">
			</div>
		</form>
	</div>
	<div class="adminzonefooter">
		<button id="save_page" class="save highlight"><?php echo t('Save'); ?></button>
		<button id="goto_page" class="btn notNew highlight"><?php echo t('See'); ?></button>
		<?php if ($_SESSION['permissions'] & 8): ?>
			<button id="delete_page" class="btn notNew highlight"><?php echo t('Delete'); ?></button>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
	$(document).on('click', ".tabs li a", function(e) {
		e.preventDefault();
		$(".panel").hide();
		$(".tabs ul .active").removeClass("active");
		$(this).parent().addClass("active");
		$($(this).attr('href')).show();
	})
	.on('mousedown change keyup', '.inputregex', function() {
		if ($('#container > div').length == 0) {
			$('#patternurlregex').removeClass("disabled");
		} else {
			$('#patternurlregex').addClass("disabled");
		}
	})
	.on('change keyup', '#patternurlregex', function() {
		$('#goto_page').hide();
		$("#patternurl").text(this.value);
	})
	.on('click', '#save_page', function(e) {
		e.preventDefault();
		$('.notNew').css("visibility", "visible");
		$('#patternurlregex').removeClass("disabled");
		$('#conf_box input[name="action"]').val("savePage");
		$('#sendFormPage').trigger('click');
		$('#goto_page').show();
		if ($('#container > div').length > 0) {
			$('#patternurlregex').addClass("disabled");
		}
	})
	.on('click', '#goto_page', function(e) {
		e.preventDefault();
		parent.location = $('#totalurl').text();
	})
	.on('click', '#delete_page', function(e) {
		e.preventDefault();
		var trad = t('Are you sure to delete this page ?');
		if (confirm(trad)) {
			$('#adminformpage input[name="action"]').val("deleteThisPage");
			$('#sendFormPage').trigger('click');
		}
	})

	.on('click', '#schema_sql .property', function() {
		var obj = $('#abc').clone().attr('id', '');
		$(".parsiname input", obj).val($(this).attr('name'));
		$(".regex input", obj).val($(this).attr('regex'));
		$(".val input", obj).val($(this).attr('val'));
		$(".modelProperty input", obj).val($(this).parent().attr("table") + "." + $(this).text());
		obj.appendTo('#container').show();
		$("#container").sortable("refresh");
		genereregex();
	})
	.on('change keyup', '.showcomponent input', function() {
		genereregex();
	})

	.on('click', '#addparam', function() {
		obj = $('#abc').clone();
		obj.removeAttr("id");
		$('.parsiname input', obj).val($('#paramname').val());
		$('.regex input', obj).val($('#paramregex').val());
		if ($('#paramregex').val() == '(.*)')
			$('.val input', obj).val('abcd');
		else
			$('.val input', obj).val('123');
		obj.appendTo('#container').show();
		$('#paramname').val('');
		genereregex();
	})

	.on('click', '#addtextcomposant', function() {
		$('#abcd').clone().removeAttr("id").appendTo('#container').show();
		genereregex();
	})

	.on('click', '.robotsOptions', function() {
		var robots = "";
		$('.robotsOptions:checked').each(function() {
			robots += $(this).data("option") + ",";
		});
		$('#SEOrobots').val(robots.substring(0, robots.length - 1));
	});

	$('input[name="title"]').blur(function() {
		if ($('input[name="title"]').val().length > 0 && $('input[name="regex"]').val().length == 0) {
			$('input[name="regex"]').addClass('active');
			$.post(BASE_PATH + "admin/titleToUrl", {TOKEN: TOKEN, url: $(this).val()},
			function(data) {
				$('input[name="regex"]').val(data);
			});
		}
	});
	$(function() {
		$("#schema_sql > div").hover(function() {
			$("li", this).next().show();
		}, function() {
			$("li", this).next().hide();
		});
		$("#container").sortable({
			placeholder: "ui-state-highlight",
			stop: function() {
				genereregex();
			}
		});
		$(".showcomponent").disableSelection();
		checkOveride('<?php echo $page->getRegex() ?>');
	});

	function genereregex() {
		$('#goto_page').hide();
		var url = '';
		var urlRegex = '';
		$('#container > div:not(#abc,#abcd)').each(function(i) {
			$("input", this).each(function() {
				$(this).attr("name", "URLcomponents[" + i + "][" + $(this).parent().attr("class").replace("parsi", "") + "]");
			});
			if ($(this).hasClass('paramdyn')) {
				url += $(".val input", this).val();
				urlRegex += "(\?<" + $(".parsiname input", this).val() + ">" + $(".regex input", this).val() + ')';
			} else {
				url += $(".text input", this).val();
				urlRegex += $(".text input", this).val();
			}
		});
		$("#patternurl").text(url);
		$("#patternurlregex").val(urlRegex);
		$(".showcomponent").show();
		checkOveride("@^" + urlRegex + "$@");
	}

	function checkOveride(regex) {
		$.post(BASE_PATH + "admin/checkOverridedPage", {TOKEN: TOKEN, module: '<?php echo $page->getModule() ?>', idpage: '<?php echo $page->getId() ?>', regex: regex}, function(data) {
			if (data.length > 0) {
				$("#pageOverride").html('<div style="background: #44C5EC;width: 531px;padding: 5px;color: #FBFBFB;">Attention this page is suspected to override and hide page ' + data + '</div>');
			} else {
				$("#pageOverride").html("");
			}
		});
	}
</script>