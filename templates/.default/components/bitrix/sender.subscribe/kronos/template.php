<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$buttonId = $this->randString();
?>
<div class="bx-subscribe"  id="sender-subscribe">

	<?
	$frame = $this->createFrame("sender-subscribe", false)->begin();

	/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
	print_r($arResult);		
	echo '</pre>';*/			
	
	
	?>
	<? if(isset($arResult['MESSAGE'])):
		if ($arResult['MESSAGE']['TYPE'] == 'NOTE') {
			?><div class="" >
				<div>Мы добавили Ваш адрес в список нашей</div>
				<div>новостной рассылки</div>
			</div><?
		} else {
			 ?>
			<div class="alert alert-danger"><?=htmlspecialcharsbx($arResult['MESSAGE']['TEXT'])?></div>
			<?
		}
		
	endif;?>
	
	<? if ($arResult['MESSAGE']['TYPE'] != 'NOTE') { ?>
		<script>
			(function () {
				var btn = BX('bx_subscribe_btn_<?=$buttonId?>');
				var form = BX('bx_subscribe_subform_<?=$buttonId?>');
	
				if(!btn)
				{
					return;
				}
	
				function mailSender()
				{
					setTimeout(function() {
						if(!btn)
						{
							return;
						}
	
						var btn_span = btn.querySelector("span");
						var btn_subscribe_width = btn_span.style.width;
						BX.addClass(btn, "send");
						btn_span.outterHTML = "<span><i class='fa fa-check'></i> <?=GetMessage("subscr_form_button_sent")?></span>";
						if(btn_subscribe_width)
						{
							btn.querySelector("span").style["min-width"] = btn_subscribe_width+"px";
						}
					}, 400);
				}
	
				BX.ready(function()
				{
					BX.bind(btn, 'click', function() {
						setTimeout(mailSender, 250);
						return false;
					});
				});
	
				BX.bind(form, 'submit', function () {
					btn.disabled=true;
					setTimeout(function () {
						btn.disabled=false;
					}, 2000);
	
					return true;
				});
			})();
		</script>

		<div class="popup__descr">Хотите раньше всех узнавать<br>о наших акция и скидках?</div>
	
		<form id="bx_subscribe_subform_<?=$buttonId?>" role="form" method="post" action="<?=$arResult["FORM_ACTION"]?>">
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="sender_subscription" value="add">
	
			<div class="bx-input-group">
				<input class="bx-form-control" type="email" name="SENDER_SUBSCRIBE_EMAIL" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=htmlspecialcharsbx(GetMessage('subscr_form_email_title'))?>">
			</div>
	
			<div style="<?=($arParams['HIDE_MAILINGS'] <> 'Y' ? '' : 'display: none;')?>">
				<?if(count($arResult["RUBRICS"])>0):?>
					<div class="bx-subscribe-desc"><?=GetMessage("subscr_form_title_desc")?></div>
				<?endif;?>
				<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
				<div class="bx_subscribe_checkbox_container">
					<input type="checkbox" name="SENDER_SUBSCRIBE_RUB_ID[]" id="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?>>
					<label for="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>"><?=htmlspecialcharsbx($itemValue["NAME"])?></label>
				</div>
				<?endforeach;?>
			</div>
	
			<?if ($arParams['USER_CONSENT'] == 'Y'):?>
			<div class="bx_subscribe_checkbox_container bx-sender-subscribe-agreement">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.userconsent.request",
					"",
					array(
						"ID" => $arParams["USER_CONSENT_ID"],
						"IS_CHECKED" => $arParams["USER_CONSENT_IS_CHECKED"],
						"AUTO_SAVE" => "Y",
						"IS_LOADED" => $arParams["USER_CONSENT_IS_LOADED"],
						"ORIGIN_ID" => "sender/sub",
						"ORIGINATOR_ID" => "",
						"REPLACE" => array(
							"button_caption" => GetMessage("subscr_form_button"),
							"fields" => array(GetMessage("subscr_form_email_title"))
						),
					)
				);?>
			</div>
			<?endif;?>
	
			<div class="bx_subscribe_submit_container">
				<button class="sender-btn btn-subscribe" id="bx_subscribe_btn_<?=$buttonId?>"><span><?=GetMessage("subscr_form_button")?></span></button>
			</div>
		</form>	
	
	<? } ?>


<?
$frame->beginStub();
?>
	<?if(isset($arResult['MESSAGE'])): CJSCore::Init(array("popup"));?>
		<div id="sender-subscribe-response-cont" style="display: none;">
			<div class="bx_subscribe_response_container">
				<table>
					<tr>
						<td style="padding-right: 40px; padding-bottom: 0px;"><img src="<?=($this->GetFolder().'/images/'.($arResult['MESSAGE']['TYPE']=='ERROR' ? 'icon-alert.png' : 'icon-ok.png'))?>" alt=""></td>
						<td>
							<div style="font-size: 22px;"><?=GetMessage('subscr_form_response_'.$arResult['MESSAGE']['TYPE'])?></div>
							<div style="font-size: 16px;"><?=htmlspecialcharsbx($arResult['MESSAGE']['TEXT'])?></div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?endif;?>

	<script>
		(function () {
			var btn = BX('bx_subscribe_btn_<?=$buttonId?>');
			var form = BX('bx_subscribe_subform_<?=$buttonId?>');

			if(!btn)
			{
				return;
			}

			function mailSender()
			{
				setTimeout(function() {
					if(!btn)
					{
						return;
					}

					var btn_span = btn.querySelector("span");
					var btn_subscribe_width = btn_span.style.width;
					BX.addClass(btn, "send");
					btn_span.outterHTML = "<span><i class='fa fa-check'></i> <?=GetMessage("subscr_form_button_sent")?></span>";
					if(btn_subscribe_width)
					{
						btn.querySelector("span").style["min-width"] = btn_subscribe_width+"px";
					}
				}, 400);
			}

			BX.ready(function()
			{
				BX.bind(btn, 'click', function() {
					setTimeout(mailSender, 250);
					return false;
				});
			});

			BX.bind(form, 'submit', function () {
				btn.disabled=true;
				setTimeout(function () {
					btn.disabled=false;
				}, 2000);

				return true;
			});
		})();
	</script>
	
	<div class="popup__descr">Хотите раньше всех узнавать<br>о наших акция и скидках?</div>

	<form id="bx_subscribe_subform_<?=$buttonId?>" role="form" method="post" action="<?=$arResult["FORM_ACTION"]?>">
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="sender_subscription" value="add">

		<div class="bx-input-group">
			<input class="bx-form-control" type="email" name="SENDER_SUBSCRIBE_EMAIL" value="" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=htmlspecialcharsbx(GetMessage('subscr_form_email_title'))?>">
		</div>

		<div style="<?=($arParams['HIDE_MAILINGS'] <> 'Y' ? '' : 'display: none;')?>">
			<?if(count($arResult["RUBRICS"])>0):?>
				<div class="bx-subscribe-desc"><?=GetMessage("subscr_form_title_desc")?></div>
			<?endif;?>
			<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
				<div class="bx_subscribe_checkbox_container">
					<input type="checkbox" name="SENDER_SUBSCRIBE_RUB_ID[]" id="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>">
					<label for="SENDER_SUBSCRIBE_RUB_ID_<?=$itemValue["ID"]?>"><?=htmlspecialcharsbx($itemValue["NAME"])?></label>
				</div>
			<?endforeach;?>
		</div>

		<div class="bx_subscribe_submit_container">
			<button class="sender-btn btn-subscribe" id="bx_subscribe_btn_<?=$buttonId?>"><span><?=GetMessage("subscr_form_button")?></span></button>
		</div>
	</form>
<?
$frame->end();
?>
</div>