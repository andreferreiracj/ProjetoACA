<?php

class AmUtil{
    const IMPOSSIBLE_MONTH = -1;
    const BOT_SIGNATURE = "For educational tests only";

    public static function leapYear(
        $pY
    ){
        return ($pY%400 === 0) || ($pY%4===0 && ($pY%100!==0));
    }

    public static function numberOfDaysInMonth(
        $pY,
        $pM
    ){
        switch($pM){
            case 1: case 3:case 5:case 7:case 8: case 10;case 12: return 31;
            case 4: case 6:case 9:case 11: return 30;
            case 2: return (self::leapYear($pY) ? 29 :  28);
            default: return self::IMPOSSIBLE_MONTH;
        }
    }

    public static function consumeUrl(
        $pUrl 
    ){
        
        $ch = curl_init($pUrl);
        if ($ch){
           
            curl_setopt(
                $ch,
                CURLOPT_HTTPGET,
                true
            );

            curl_setopt(
                $ch,
                CURLOPT_SSL_VERIFYPEER,
                true
            );

         
            curl_setopt(
                $ch,
                CURLOPT_USERAGENT,
                self::BOT_SIGNATURE
            );

           
            curl_setopt(
                $ch,
                CURLOPT_RETURNTRANSFER,
                true
            );

           
            curl_setopt(
                $ch,
                CURLOPT_BINARYTRANSFER, 
                true
            );

           
            curl_setopt(
                $ch,
                CURLOPT_ENCODING,
                ""
            );

            $bin = curl_exec($ch);

            return $bin;
        }
        return false;
    }
    const KEY_HREF = "HREF";
    const KEY_ANCHOR = "ANCHOR";
    public static function extractHyperlinksFromHtmlSourceCode(
        string $pStrHtmlSourceCode
    ) 
    {
        $aRet = []; 
        $oDom = new DOMDocument();
        
        if ($oDom){
            
            @$oDom->loadHTML($pStrHtmlSourceCode);
            $as = $oDom->getElementsByTagName('article');
            foreach ($as as $someAElement){
                $strHref = trim($someAElement->childNodes[0]->childNodes[0]->getAttribute('href'));
                var_dump($strHref);
                $aPair = [
                    self::KEY_HREF => $strHref,
                    
                ];

                $aRet[] = $aPair;
            }
        }
        return $aRet;
    }

    const IMAGE_FILTERS = [
        ".jpg", ".png", ".jp2", ".gif",
        ".gifv", ".bmp", ".svg"
    ];
    public static function
filterHyperlinksKeepingOnlyThoseWithHrefsEndingIn(
        $paHyperlinksAsPairsAnchorsHref,
        $paFilters = [], 
        $pStrURLPrefixIfSchemaIsMissing = "https:"
    )
    {
        $aRet = [];
        $hrefs = []; 

        $bShouldDoNothing =
            is_array($paFilters) && count($paFilters)===0;

        if ($bShouldDoNothing)
            return $paHyperlinksAsPairsAnchorsHref;

        
        foreach (
            $paHyperlinksAsPairsAnchorsHref
            as
            $aPair
        ){
            $strAnchor = $aPair[self::KEY_ANCHOR];
            $strHref = $aPair[self::KEY_HREF];

            $bHrefEndsInAtLeastOneOfTheFilters =
                self::stringEndsInOneOfTheFollowing(
                    $strHref,
                    $paFilters
                );

            if ($bHrefEndsInAtLeastOneOfTheFilters){
                $bUrlIsMissingSchema = stripos(
                    $strHref, "//"
                ) === 0;
                if ($bUrlIsMissingSchema){
                    $strHref =
                        "$pStrURLPrefixIfSchemaIsMissing$strHref";

                    $aPair[self::KEY_HREF] = $strHref;
                }

                $bHrefFoundAlreadyExistsInCollectionOfHrefs =
                    array_search(
                        $strHref,
                        $hrefs
                    ) !== false;

                $bNewHref = !$bHrefFoundAlreadyExistsInCollectionOfHrefs;
                if ($bNewHref){
                    $hrefs[] = $strHref; 
                    $aRet[] = $aPair; 
                }
                else{
                   
                }
            }
        }

        return $aRet;
    }
    public static function stringEndsInOneOfTheFollowing(
        string $pStr,
        array $paTerminations,
        bool $pbCaseInsensitive = true
    ){
        foreach($paTerminations as $someTermination){
            if ($pbCaseInsensitive){
                $iWhereDoesTheTerminationOccur =
                    strripos($pStr, $someTermination);
            }//if
            else{
                $iWhereDoesTheTerminationOccur =
                    strrpos($pStr, $someTermination);
            }

            $bTerminationOccurs =
                $iWhereDoesTheTerminationOccur!==false;

            if ($bTerminationOccurs){
                
                $bExactlyAtTheEnd =
                    strlen($pStr) ===
                        $iWhereDoesTheTerminationOccur +
                        strlen($someTermination);
                if ($bExactlyAtTheEnd) return true;
            }
        }
        return false;
    }

    const INVALID_FILENAME_SYMBOLS =
        [":", "/", "\\", "*", "?", "<", ">", "|", "\""];

    public static function sanitizeStringForFileSystem(
        $pStrToSanitize,
        $pStrReplacementSymbol = "_"
    ){
        foreach (self::INVALID_FILENAME_SYMBOLS as $strReplaceThis){
            $pStrToSanitize = str_replace(
                $strReplaceThis,
                $pStrReplacementSymbol,
                $pStrToSanitize
            );
        }

        return $pStrToSanitize;
    }
}