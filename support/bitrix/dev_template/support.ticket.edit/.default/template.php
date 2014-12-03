<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$APPLICATION->AddHeadScript($this->GetFolder() . '/ru/script.js');
if (!empty($arResult["TICKET"])) {
    $APPLICATION->SetTitle('#' . $arResult['TICKET']['ID'] . ' ' . $arResult['TICKET']['TITLE']);
}
?>
<div class="columns">
<?= ShowError($arResult["ERROR_MESSAGE"]); ?>

<?
/*$hkInst=CHotKeys::getInstance();
$arHK = array("B", "I", "U", "QUOTE", "CODE", "TRANSLIT");
foreach($arHK as $n => $s)
{
    $arExecs = $hkInst->GetCodeByClassName("TICKET_EDIT_$s");
    echo $hkInst->PrintJSExecs($arExecs);
}*/

if (!empty($arResult["TICKET"])) {
    ?>
    <? if (!empty($arResult["ONLINE"])) { ?>
        <div class="last5min">
            <? $time = intval($arResult["OPTIONS"]["ONLINE_INTERVAL"] / 60) . " " . GetMessage("SUP_MIN"); ?>
            <?= str_replace("#TIME#", $time, GetMessage("SUP_USERS_ONLINE")); ?>:
            <? foreach ($arResult["ONLINE"] as $arOnlineUser): ?>
                <?
                if (trim($arOnlineUser["USER_NAME"]) != '') {
                    echo $arOnlineUser["USER_NAME"];
                } else {
                    echo $arOnlineUser["USER_LOGIN"];
                }?>(<?= $arOnlineUser["USER_EMAIL_FUTURE"] ?>)

            <? endforeach ?>
        </div>
    <? } ?>

    <a class="button" href="/personal/support/">Мои обращения</a>





    <div class="row">
        <div class="columns">
            <div class="b-ticket-subj">
                <!--<div class="b-ticket-subj__title">Обращение</div>-->

                <div class="b-ticket-subj__text">
                    <div class="row">
                        <div class="columns medium-6">
                            <? if (strlen($arResult["TICKET"]["STATUS_NAME"]) > 0) : ?>
                                <b><?= GetMessage("SUP_STATUS") ?>:</b> <span
                                    title="<?= $arResult["TICKET"]["STATUS_DESC"] ?>"><?= $arResult["TICKET"]["STATUS_NAME"] ?></span>
                                <br/>
                            <? endif; ?>

                    <!--<b>Заголовок:</b>
                    <?/*= $arResult["TICKET"]["TITLE"] */?>
                    <br/>-->

                            <? if (strlen($arResult["TICKET"]["CATEGORY_NAME"]) > 0): ?>
                                <b><?= GetMessage("SUP_CATEGORY") ?>:</b> <span
                                    title="<?= $arResult["TICKET"]["CATEGORY_DESC"] ?>"><?= $arResult["TICKET"]["CATEGORY_NAME"] ?></span>
                                <br/>
                            <? endif ?>


                            <? if (strlen($arResult["TICKET"]["CRITICALITY_NAME"]) > 0) : ?>
                                <b><?= GetMessage("SUP_CRITICALITY") ?>:</b> <span
                                    title="<?= $arResult["TICKET"]["CRITICALITY_DESC"] ?>"><?= $arResult["TICKET"]["CRITICALITY_NAME"] ?></span>
                                <br/>
                            <? endif ?>


                            <? if (intval($arResult["RESPONSIBLE_USER_ID"]) > 0): ?>
                                <b><?= GetMessage("SUP_RESPONSIBLE") ?>:</b> [<?= $arResult["TICKET"]["RESPONSIBLE_USER_ID"] ?>]
                                (<?= $arResult["TICKET"]["RESPONSIBLE_LOGIN"] ?>) <?= $arResult["TICKET"]["RESPONSIBLE_NAME"] ?>
                                <br/>
                            <? endif ?>


                            <? if (strlen($arResult["TICKET"]["SLA_NAME"]) > 0) : ?>
                                <b><?= GetMessage("SUP_SLA") ?>:</b>
                                <span
                                    title="<?= $arResult["TICKET"]["SLA_DESCRIPTION"] ?>"><?= $arResult["TICKET"]["SLA_NAME"] ?></span>
                            <? endif ?>


                        </div>

                        <div class="columns medium-6">

                            <b><?= GetMessage("SUP_FROM") ?>:</b>

                            <? if (strlen($arResult["TICKET"]["OWNER_SID"]) > 0): ?>
                                <?= $arResult["TICKET"]["OWNER_SID"] ?>
                            <? endif ?>

                            <? if (intval($arResult["TICKET"]["OWNER_USER_ID"]) > 0): ?>
                                <?
                                if (trim($arResult["TICKET"]["OWNER_NAME"]) != '') {
                                    echo $arResult["TICKET"]["OWNER_NAME"];
                                } else {
                                    echo $arResult["TICKET"]["OWNER_LOGIN"];
                                }
                                ?>  (<a
                                    href="mailto:<?= $arResult['TICKET']['OWNER_EMAIL_FUTURE'] ?>"><?= $arResult['TICKET']['OWNER_EMAIL_FUTURE'] ?></a>)
                            <? endif ?>
                            <br/>


                            <!--<b><?/*= GetMessage("SUP_CREATE") */?>:</b>

                    <?/* if (strlen($arResult["TICKET"]["CREATED_MODULE_NAME"]) <= 0 || $arResult["TICKET"]["CREATED_MODULE_NAME"] == "support"): */?>
                        <?/*
                        if (trim($arResult["TICKET"]["CREATED_NAME"]) != '') {
                            echo $arResult["TICKET"]["CREATED_NAME"];
                        } else {
                            echo $arResult["TICKET"]["CREATED_LOGIN"];
                        }
                        */?> (<a
                            href="mailto:<?/*= $arResult['TICKET']['CREATED_EMAIL_FUTURE'] */?>"><?/*= $arResult['TICKET']['CREATED_EMAIL_FUTURE'] */?></a>)
                    <?/* else: */?>
                        <?/*= $arResult["TICKET"]["CREATED_MODULE_NAME"] */?>
                    <?/*endif */?>
                    <br/>-->


                            <? if ($arResult["TICKET"]["DATE_CREATE"] != $arResult["TICKET"]["TIMESTAMP_X"]): ?>
                                <b><?= GetMessage("SUP_TIMESTAMP") ?>:</b>

                                <? if (strlen($arResult["TICKET"]["MODIFIED_MODULE_NAME"]) <= 0 || $arResult["TICKET"]["MODIFIED_MODULE_NAME"] == "support"): ?>
                                    <?
                                    if (trim($arResult['TICKET']['MODIFIED_USER_ID']) != '') {
                                        echo $arResult["TICKET"]["MODIFIED_BY_NAME"];
                                    } else {
                                        echo $arResult["TICKET"]["MODIFIED_BY_LOGIN"];
                                    }
                                    ?>
                                <? else: ?>
                                    <?= $arResult["TICKET"]["MODIFIED_MODULE_NAME"] ?>
                                <?endif ?>
                                <?= $arResult["TICKET"]["TIMESTAMP_X"] ?>
                                <br/>
                            <? endif ?>


                            <? if (strlen($arResult["TICKET"]["DATE_CLOSE"]) > 0): ?>
                                <b><?= GetMessage("SUP_CLOSE") ?>:</b> <?= $arResult["TICKET"]["DATE_CLOSE"] ?><br/>
                            <? endif ?>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="b-ticket-discussion">
        <div class="b-ticket-discussion__title"><?= GetMessage("SUP_DISCUSSION") ?></div>
        <? foreach ($arResult["MESSAGES"] as $arMessage) { ?>
            <div class="b-ticket-discussion-elem">
                <div class="b-ticket-discussion-elem-header <?if($arMessage["OWNER_USER_ID"] == 1) echo 'b-ticket-discussion-elem-header_green-border'?>">
                    <div class="b-ticket-discussion-elem__date">
                        <?= $arMessage["DATE_CREATE"] ?>
                    </div>
                    <div class="b-ticket-discussion-elem__name">
                        <?
                        //print_r($arMessage);
                        if (intval($arMessage["OWNER_USER_ID"]) > 0):?>
                            <?
                            if (strlen(trim($arMessage["OWNER_NAME"])) > 0) {

                                echo $arMessage["OWNER_NAME"];
                            } else {
                                echo $arMessage["OWNER_LOGIN"];
                            }
                            ?>
                        <? endif ?>

                        (<a href="mailto:<?= $arMessage['FUTURE_USER_EMAIL'] ?>"><?= $arMessage['FUTURE_USER_EMAIL'] ?></a>)

                    </div>
                </div>
                <div class="b-ticket-discussion-elem__text">
                    <?
                    $aImg = array("gif", "png", "jpg", "jpeg", "bmp");
                    foreach ($arMessage["FILES"] as $arFile):
                        ?>
                        <div class="support-paperclip"></div>
                        <? if (in_array(strtolower(GetFileExtension($arFile["NAME"])), $aImg)): ?>
                        <a title="<?= GetMessage("SUP_VIEW_ALT") ?>"
                           href="<?= $componentPath ?>/ticket_show_file.php?hash=<? echo $arFile["HASH"] ?>&amp;lang=<?= LANG ?>"><?= $arFile["NAME"] ?></a>
                    <? else: ?>
                        <?= $arFile["NAME"] ?>
                    <?endif ?>
                        (<? echo CFile::FormatSize($arFile["FILE_SIZE"]); ?>)
                        [ <a title="<?= str_replace("#FILE_NAME#", $arFile["NAME"], GetMessage("SUP_DOWNLOAD_ALT")) ?>"
                             href="<?= $componentPath ?>/ticket_show_file.php?hash=<?= $arFile["HASH"] ?>&amp;lang=<?= LANG ?>&amp;action=download"><?= GetMessage("SUP_DOWNLOAD") ?></a> ]
                        <br class="clear"/>
                    <? endforeach ?>
                    <?= $arMessage["MESSAGE"] ?>
                </div>
            </div>
        <? } ?>
    </div>



<? } ?>
</div>
</div>
<div class="semi4-grey-row">
<div class="row">
    <div class="columns">
<form name="support_edit" method="post" action="<?= $arResult["REAL_FILE_PATH"] ?>" enctype="multipart/form-data">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="set_default" value="Y"/>
    <input type="hidden" name="ID" value=<?= (empty($arResult["TICKET"]) ? 0 : $arResult["TICKET"]["ID"]) ?>/>
    <input type="hidden" name="lang" value="<?= LANG ?>"/>
    <input type="hidden" name="edit" value="1"/>

    <div class="b-ticket-response">
        <? if (empty($arResult["TICKET"])): ?>
        <div class="b-ticket-response__title"><?= GetMessage("SUP_TICKET") ?></div>
        <div class="b-ticket-response-input">
            <div class="row">
                <div class="columns large-8">
                    <div class="b-ticket-response-input-elem">
                        <div class="b-ticket-response-input-elem__label f18"><?= GetMessage("SUP_TITLE") ?></div>
                        <div class="b-ticket-response-input-elem__input">
                            <input type="text" name="TITLE" value="<?= htmlspecialcharsbx($_REQUEST["TITLE"]) ?>"
                                   size="48"
                                   maxlength="255"/>
                        </div>
                    </div>
                    <? else: ?>
                    <div class="b-ticket-response__title"><?= GetMessage("SUP_ANSWER") ?></div>
                    <div class="b-ticket-response-input">
                        <div class="row">
                            <div class="columns large-8">


                                <? endif ?>
                                <div class="b-ticket-response-input-elem">
                                    <div class="b-ticket-response-input-elem__label f18">Сообщение</div>
                                    <div
                                        class="b-ticket-response-input-elem__input b-ticket-response-input-elem__input_textarea">
                                        <textarea name="MESSAGE" id="MESSAGE" rows="20"
                                                  cols="45"><?= trim(htmlspecialcharsbx($_REQUEST["MESSAGE"])) ?></textarea>
                                    </div>
                                </div>
                                <div class="b-ticket-response-input-elem">
                                    <div class="b-ticket-response-input-elem__label left">

                                        <input type="hidden" name="MAX_FILE_SIZE"
                                               value="<?= ($arResult["OPTIONS"]["MAX_FILESIZE"] * 1024) ?>">
                                    </div>
                                    <div
                                        class="b-ticket-response-input-elem__input b-ticket-response-input-elem__input_file">
                                        <label><input name="FILE_0" onchange="changeLabelText(this)"
                                                      style="position: absolute; clip: rect(0,0,0,0)" size="30"
                                                      type="file"/><span class="button nomb f14">Прикрепить файл</span><span
                                                class="filename">Файл не выбран</span>
                                        </label>
                                        <br/>
                                        <span id="files_table_0"></span>
                                        <a href="#" OnClick="AddFileInputt();return false;" class="f14 flight">Добавить еще</a>
                                        <input type="hidden" name="files_counter" id="files_counter" value="0"/>
                                    </div>
                                </div>
                                <div class="b-ticket-response-input-elem">
                                    <div class="b-ticket-response-input-elem__label f18">
                                        <?= GetMessage("SUP_CRITICALITY") ?>
                                    </div>
                                    <div class="b-ticket-response-input-elem__input">
                                        <?
                                        if (empty($arResult["TICKET"]) || strlen($arResult["ERROR_MESSAGE"]) > 0) {
                                            if (strlen($arResult["DICTIONARY"]["CRITICALITY_DEFAULT"]) > 0 && strlen($arResult["ERROR_MESSAGE"]) <= 0)
                                                $criticality = $arResult["DICTIONARY"]["CRITICALITY_DEFAULT"];
                                            else
                                                $criticality = htmlspecialcharsbx($_REQUEST["CRITICALITY_ID"]);
                                        } else
                                            $criticality = $arResult["TICKET"]["CRITICALITY_ID"];
                                        ?>
                                        <select name="CRITICALITY_ID" id="CRITICALITY_ID">
                                            <option value="">&nbsp;</option>
                                            <? foreach ($arResult["DICTIONARY"]["CRITICALITY"] as $value => $option): ?>
                                                <option value="<?= $value ?>"
                                                        <? if ($criticality == $value): ?>selected="selected"<? endif ?>><?= $option ?></option>
                                            <? endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <? if (empty($arResult["TICKET"])): ?>
                                    <div class="b-ticket-response-input-elem">
                                        <div class="b-ticket-response-input-elem__label f18">
                                            <?= GetMessage("SUP_CATEGORY") ?>
                                        </div>
                                        <div class="b-ticket-response-input-elem__input">
                                            <?
                                            if (strlen($arResult["DICTIONARY"]["CATEGORY_DEFAULT"]) > 0 && strlen($arResult["ERROR_MESSAGE"]) <= 0)
                                                $category = $arResult["DICTIONARY"]["CATEGORY_DEFAULT"];
                                            else
                                                $category = htmlspecialcharsbx($_REQUEST["CATEGORY_ID"]);
                                            ?>
                                            <select name="CATEGORY_ID" id="CATEGORY_ID">
                                                <option value="">&nbsp;</option>
                                                <? foreach ($arResult["DICTIONARY"]["CATEGORY"] as $value => $option): ?>
                                                    <option value="<?= $value ?>"
                                                            <? if ($category == $value): ?>selected="selected"<? endif ?>><?= $option ?></option>
                                                <? endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                <? else: ?>
                                    <div class="b-ticket-response-input-elem">
                                        <div class="b-ticket-response-input-elem__label has-next-hidden">
                                            <span><?= GetMessage("SUP_MARK") ?></span>
                                        </div>
                                        <div class="b-ticket-response-input-elem__input hidden">
                                            <? $mark = (strlen($arResult["ERROR_MESSAGE"]) > 0 ? htmlspecialcharsbx($_REQUEST["MARK_ID"]) : $arResult["TICKET"]["MARK_ID"]); ?>
                                            <select name="MARK_ID" id="MARK_ID">
                                                <option value="">&nbsp;</option>
                                                <? foreach ($arResult["DICTIONARY"]["MARK"] as $value => $option): ?>
                                                    <option value="<?= $value ?>"
                                                            <? if ($mark == $value): ?>selected="selected"<? endif ?>><?= $option ?></option>
                                                <? endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                <? endif ?>
                                <? if (strlen($arResult["TICKET"]["DATE_CLOSE"]) <= 0): ?>
                                    <div class="b-ticket-response-input-elem">
                                        <div
                                            class="b-ticket-response-input-elem__input b-ticket-response-input-elem__input_checkbox left">
                                            <input id="SUP_CLOSE_TICKET" type="checkbox" name="CLOSE" value="Y"
                                                   <? if ($arResult["TICKET"]["CLOSE"] == "Y"): ?>checked="checked" <? endif ?>/>
                                        </div>
                                        <label for="SUP_CLOSE_TICKET">
                                            <div class="b-ticket-response-input-elem__label text-black left" >
                                                <?= GetMessage("SUP_CLOSE_TICKET") ?>
                                            </div>
                                        </label>
                                    </div>
                                <? else: ?>
                                    <div class="b-ticket-response-input-elem">

                                        <div
                                            class="b-ticket-response-input-elem__input  b-ticket-response-input-elem__input_checkbox left">
                                            <input id="SUP_OPEN_TICKET" type="checkbox" name="OPEN" value="Y"
                                                   <? if ($arResult["TICKET"]["OPEN"] == "Y"): ?>checked="checked" <? endif ?>/>
                                        </div>
                                        <label for="SUP_OPEN_TICKET">
                                            <div class="b-ticket-response-input-elem__label text-black left">
                                                <?= GetMessage("SUP_OPEN_TICKET") ?>
                                            </div>
                                        <label>
                                    </div>
                                <? endif ?>
                                <? if ($arParams['SHOW_COUPON_FIELD'] == 'Y' && $arParams['ID'] <= 0) { ?>
                                    <div class="b-ticket-response-input-elem">
                                        <div class="b-ticket-response-input-elem__label">
                                            <?= GetMessage("SUP_COUPON") ?>
                                        </div>
                                        <div class="b-ticket-response-input-elem__input">
                                            <input type="text" name="COUPON"
                                                   value="<?= htmlspecialcharsbx($_REQUEST["COUPON"]) ?>"
                                                   size="48"
                                                   maxlength="255"/>
                                        </div>
                                    </div>

                                <? } ?>
                                <?if($arResult['TICKET']['ID']){?>
                                    <input class="button" type="submit" name="apply" value="<?= GetMessage("SUP_APPLY") ?>"/>
                                <?}else{?>
                                    <input class="button" type="submit" name="save" value="<?= GetMessage("SUP_SAVE") ?>"/>
                                <?}?>
                                <?/*?><input class="button" type="reset" value="<?= GetMessage("SUP_RESET") ?>"/><?*/?>
                                <input type="hidden" value="Y" name="apply"/>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    BX.ready(function () {
                        var buttons = BX.findChildren(document.forms['support_edit'], {attr: {type: 'submit'}});
                        for (i in buttons) {
                            BX.bind(buttons[i], "click", function (e) {
                                setTimeout(function () {
                                    var _buttons = BX.findChildren(document.forms['support_edit'], {attr: {type: 'submit'}});
                                    for (j in _buttons) {
                                        _buttons[j].disabled = true;
                                    }

                                }, 30);
                            });
                        }
                    });
                </script>

</form>
</div>
    </div>
    </div>
<div class="row">