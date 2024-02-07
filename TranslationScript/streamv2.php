<?php
 // Dragon Translation logic starts here
 
 // access the json file that contain words
 $dragonTranslations = json_decode(file_get_contents('dragon.json'), true);
 // json debug start
 if (json_last_error() !== JSON_ERROR_NONE) {
    $errorMsg = "Error decoding dragon.json: " . json_last_error_msg();

    // Determine the current directory
    $currentDirectory = dirname(__DIR__); 

    // Specify your custom error log filename
    $errorLogFilename = "DragonError.log";
    $errorLogPath = $currentDirectory . '/' . $errorLogFilename;

    // Write the error message to your custom error log DragonError.log
    error_log($errorMsg, 3, $errorLogPath); // '3' indicates writing to a custom file

}
// json debug stop

//get the words into ai reply
$words = explode(" ", trim($sentence));
$translatedWords = [];

// search for a "s" at end of words, if there is one remove it then search for his singular form
foreach ($words as $word) {
    $wordToQuery = strtolower($word);
    if(substr($wordToQuery, -1) == 's') {
        $wordToQuery = rtrim($wordToQuery, 's');
    }

    // convert the full word to lowercase so even fOrCE will be translated to "Fus" can be recognized
    $dragonWord = isset($dragonTranslations[$wordToQuery]) ? $dragonTranslations[$wordToQuery] : null;

    // convert first letter into uppercase
    $translatedWords[] = $dragonWord ? ucfirst($dragonWord) : $word;
}

$sentence = implode(" ", $translatedWords);
// Dragon Translation logic ends here
?>
