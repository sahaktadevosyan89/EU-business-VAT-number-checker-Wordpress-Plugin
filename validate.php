<?php
require_once('vatValidation.class.php');
require_once('countries.php');

$vatValidation = new vatValidation(array(
    'debug' => false
));

if (isset($_POST['vatnumber'])) {
    $vatnumber = $_POST['vatnumber'];   
    $countryCode = substr($vatnumber, 0, 2);
    $number      = substr($vatnumber, 2);
    $output      = preg_replace('/[^0-9]/', '', $number);
    
    if (!$output || !array_key_exists($countryCode, $countries)) {
        ?>
        <div class="vatnumber-error-message">
            <span>
                Please enter your VAT-ID including the ISO-3166 two letter country code.
            </span>
        </div>
    <?php
    } else {
        if ($vatValidation->check($countryCode, $output)) {
?>
       <div class="vatnumber-success-message">
            <span>
                Your VAT-ID is valid.
            </span>
       </div>
        <div class="vatnumber-success-message">
            <span>
                We have identified you as EU business, you can order VAT-exempt in our shop now.
            </span>
       </div>
        <?php
        } else {
            ?>
                <div class="vatnumber-error-message">
                    <span>
                    The given VAT-ID is invalid, please check the syntax. If this error remains please contact us directly to register a customer account with exempt from taxation with us.
                     
                    </span>
                </div>
            <?php
        }
    }
} else {
?>
    <div class="vatnumber-error-message">
        <span>
            Please enter your VAT-ID including the ISO-3166 two letter country code.
        </span>
    </div>
<?php
}
?>