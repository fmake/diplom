<?
if ($arResult["MESSAGES"]) {
    foreach ($arResult["MESSAGES"] as $key => $arMessage) {
        $rsUser = CUser::GetByID($arMessage['OWNER_USER_ID']);
        $arUser = $rsUser->Fetch();
        $arResult["MESSAGES"][$key]['FUTURE_USER_EMAIL'] = $arUser['EMAIL'];
    }
}
if (!empty($arResult["TICKET"])) {
    $rsUser = CUser::GetByID($arResult['TICKET']['OWNER_USER_ID']);
    $arUser = $rsUser->Fetch();
    $arResult['TICKET']['OWNER_EMAIL_FUTURE'] = $arUser['EMAIL'];

    $rsUser = CUser::GetByID($arResult['TICKET']['CREATED_USER_ID']);
    $arUser = $rsUser->Fetch();
    $arResult['TICKET']['CREATED_EMAIL_FUTURE'] = $arUser['EMAIL'];

    $rsUser = CUser::GetByID($arResult['TICKET']['CREATED_USER_ID']);
    $arUser = $rsUser->Fetch();
    $arResult['TICKET']['CREATED_EMAIL_FUTURE'] = $arUser['EMAIL'];
}
if ($arResult["ONLINE"]) {
    foreach ($arResult["ONLINE"] as $key => $arOnlineUser) {
        $rsUser = CUser::GetByID($arOnlineUser["USER_ID"]);
        $arUser = $rsUser->Fetch();
        $arResult["ONLINE"][$key]["USER_EMAIL_FUTURE"] = $arUser['EMAIL'];
    }
}?>