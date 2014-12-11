<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Техподдержка");
?>
<br/>
<div class="row">
    <div class="columns">
        <h1 class="mt-10 mb16"><? $APPLICATION->ShowTitle(false) ?></h1>
    </div>
    <div style="clear:both;"></div>
    <?
    /*рассписание тех поддержки*/
    global $DB;
    $slaID = 0;
    $strSql = "SELECT * FROM b_ticket_sla_shedule WHERE SLA_ID = $slaID ORDER BY WEEKDAY_NUMBER, MINUTE_FROM, MINUTE_TILL";
    $rs = $DB->Query($strSql, false, __LINE__);
    while($ar = $rs->Fetch())
    {
        $key = (($ar["WEEKDAY_NUMBER"]+1) == 7)?0:($ar["WEEKDAY_NUMBER"]+1);
        if ($ar["OPEN_TIME"]=="CUSTOM")
        {
            if (intval($ar["MINUTE_FROM"])>0)
            {
                $h_from = floor($ar["MINUTE_FROM"]/60);
                $m_from = $ar["MINUTE_FROM"] - $h_from*60;
            }
            if (intval($ar["MINUTE_TILL"])>0)
            {
                $h_till = floor($ar["MINUTE_TILL"]/60);
                $m_till = $ar["MINUTE_TILL"] - $h_till*60;
            }
            $arResult[$key]["OPEN_TIME"] = $ar["OPEN_TIME"];
            $arResult[$key]["CUSTOM_TIME"][] = array(
                "MINUTE_FROM"	=> $ar["MINUTE_FROM"],
                "SECOND_FROM"	=> $ar["MINUTE_FROM"]*60,
                "MINUTE_TILL"	=> $ar["MINUTE_TILL"],
                "SECOND_TILL"	=> $ar["MINUTE_TILL"]*60,
                "FROM"			=> $h_from.":".str_pad($m_from, 2, 0),
                "TILL"			=> $h_till.":".str_pad($m_till, 2, 0)
            );
        }
        else
        {
            $arResult[$key] = array("OPEN_TIME" => $ar["OPEN_TIME"]);
        }
        $arResult[$key]["WEEKDAY_TITLE"] = (($ar["WEEKDAY_NUMBER"]+1) == 7)?0:($ar["WEEKDAY_NUMBER"]+1);
    }
    //print_r($arResult);
    $w = date("w");
    $time_next = time();
    while($w_next = date("w",strtotime("+1 day",$time_next))){
        $time_next = strtotime("+1 day",$time_next);
        if($arResult[$w_next]['OPEN_TIME'] != 'CLOSED') break;
    }
    //echo date('d.m.Y',$time_next);
    $date_from = strtotime(date("d.m.Y")." ".$arResult[$w]['CUSTOM_TIME'][0]['FROM']);
    $date_to = strtotime(date("d.m.Y")." ".$arResult[$w]['CUSTOM_TIME'][0]['TILL']);

    if($time_next>$date_from  && date("H")<=10){
        $time_next = strtotime("-1 day",$time_next);
        $w_next = date("w",$time_next);
    }

    if($arResult[$w]['OPEN_TIME'] == 'CLOSED' || time()<$date_from || $date_to<time() ){
        ?>
        <div style="border:2px solid red;border-radius:6px;color:red;padding:10px;margin-bottom:10px;margin-left: 0.9375em;margin-right: 0.9375em;">
            Сейчас команда Future отдыхает и набирается новых сил, но вы можете оставить обращение. Мы начнем работать <b><?=date('d.m.Y',$time_next)?></b> в <?=$arResult[$w_next]['CUSTOM_TIME'][0]['FROM']?> по московскому времени. С этого времени мы максимально быстро решим Вашу проблему.
        </div>
    <?
    }
    /*рассписание тех поддержки*/
    ?>

    <?$APPLICATION->IncludeComponent(
	"bitrix:support.ticket", 
	"dev_template",
	array(
		"SEF_MODE" => "Y",
		"TICKETS_PER_PAGE" => "50",
		"MESSAGES_PER_PAGE" => "20",
		"MESSAGE_MAX_LENGTH" => "70",
		"MESSAGE_SORT_ORDER" => "asc",
		"SET_PAGE_TITLE" => "Y",
		"SHOW_COUPON_FIELD" => "Y",
		"SET_SHOW_USER_FIELD" => array(
		),
		"SEF_FOLDER" => "/personal/support/",
		"SEF_URL_TEMPLATES" => array(
			"ticket_list" => "index.php",
			"ticket_edit" => "#ID#/",
		)
	),
	false
);?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>