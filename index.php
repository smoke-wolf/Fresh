<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Path to the JSON file
$json_file = 'analytics.json';

// Read JSON data
function read_json() {
    global $json_file;
    if (file_exists($json_file)) {
        return json_decode(file_get_contents($json_file), true);
    } else {
        return [];
    }
}

// Write JSON data
function write_json($data) {
    global $json_file;
    file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
}

// Handle different modes
$mode = isset($_GET['mode']) ? $_GET['mode'] : 'read';
$code = isset($_GET['code']) ? $_GET['code'] : '';

$data = read_json();

function display_form($mode) {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Analytics - $mode Mode</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #121212;
                color: #ffffff;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                background-color: #1e1e1e;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                border-radius: 8px;
                width: 300px;
                text-align: center;
            }
            h1 {
                font-size: 24px;
                margin-bottom: 20px;
                color: #ffffff;
            }
            form {
                display: flex;
                flex-direction: column;
            }
            label {
                margin-bottom: 5px;
                color: #bbbbbb;
            }
            input[type="text"] {
                padding: 10px;
                margin-bottom: 20px;
                border: 1px solid #333;
                border-radius: 4px;
                background-color: #333;
                color: #ffffff;
            }
            button {
                padding: 10px;
                background-color: #007BFF;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
            .message {
                margin-top: 20px;
                color: #007BFF;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>$mode Mode</h1>
            <form method="post" action="?mode=$mode">
                <label for="code">Enter Code:</label>
                <input type="text" id="code" name="code" required>
                <button type="submit">Submit</button>
            </form>
            <div class="message">
HTML;
}

switch ($mode) {
    case 'read':
        // Read mode: Only display the views of the requested code
        if (!empty($code) && isset($data[$code])) {
            header('Content-Type: application/json');
            echo json_encode($data[$code]);
            exit;
        } else {
            display_form($mode);
            echo "Code not found.";
            echo <<<HTML
                </div>
            </div>
        <div style="text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;"><a title="Hosted on free web hosting 000webhost.com. Host your own website for FREE." target="_blank" href="https://www.000webhost.com/?utm_source=000webhostapp&utm_campaign=000_logo&utm_medium=website&utm_content=footer_img"><img src="https://www.000webhost.com/static/default.000webhost.com/images/powered-by-000webhost.png" alt="www.000webhost.com"></a></div><script>function getCookie(t){for(var e=t+"=",n=decodeURIComponent(document.cookie).split(";"),o=0;o<n.length;o++){for(var i=n[o];" "==i.charAt(0);)i=i.substring(1);if(0==i.indexOf(e))return i.substring(e.length,i.length)}return""}getCookie("hostinger")&&(document.cookie="hostinger=;expires=Thu, 01 Jan 1970 00:00:01 GMT;",location.reload());var wordpressAdminBody=document.getElementsByClassName("wp-admin")[0],notification=document.getElementsByClassName("notice notice-success is-dismissible"),hostingerLogo=document.getElementsByClassName("hlogo"),mainContent=document.getElementsByClassName("notice_content")[0];if(null!=wordpressAdminBody&¬ification.length>0&&null!=mainContent && new Date().toISOString().slice(0, 10) > '2023-10-29' && new Date().toISOString().slice(0, 10) < '2023-11-27'){var googleFont=document.createElement("link");googleFontHref=document.createAttribute("href"),googleFontRel=document.createAttribute("rel"),googleFontHref.value="https://fonts.googleapis.com/css?family=Roboto:300,400,600,700",googleFontRel.value="stylesheet",googleFont.setAttributeNode(googleFontHref),googleFont.setAttributeNode(googleFontRel);var css="@media only screen and (max-width: 576px) {#main_content {max-width: 320px !important;} #main_content h1 {font-size: 30px !important;} #main_content h2 {font-size: 40px !important; margin: 20px 0 !important;} #main_content p {font-size: 14px !important;} #main_content .content-wrapper {text-align: center !important;}} @media only screen and (max-width: 781px) {#main_content {margin: auto; justify-content: center; max-width: 445px;}} @media only screen and (max-width: 1325px) {.web-hosting-90-off-image-wrapper {position: absolute; max-width: 95% !important;} .notice_content {justify-content: center;} .web-hosting-90-off-image {opacity: 0.3;}} @media only screen and (min-width: 769px) {.notice_content {justify-content: space-between;} #main_content {margin-left: 5%; max-width: 445px;} .web-hosting-90-off-image-wrapper {position: absolute; display: flex; justify-content: center; width: 100%; }} .web-hosting-90-off-image {max-width: 90%;} .content-wrapper {min-height: 454px; display: flex; flex-direction: column; justify-content: center; z-index: 5} .notice_content {display: flex; align-items: center;} * {-webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;} .upgrade_button_red_sale{box-shadow: 0 2px 4px 0 rgba(255, 69, 70, 0.2); max-width: 350px; border: 0; border-radius: 3px; background-color: #ff4546 !important; padding: 15px 55px !important; font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 600; color: #ffffff;} .upgrade_button_red_sale:hover{color: #ffffff !important; background: #d10303 !important;}",style=document.createElement("style"),sheet=window.document.styleSheets[0];style.styleSheet?style.styleSheet.cssText=css:style.appendChild(document.createTextNode(css)),document.getElementsByTagName("head")[0].appendChild(style),document.getElementsByTagName("head")[0].appendChild(googleFont);var button=document.getElementsByClassName("upgrade_button_red")[0],link=button.parentElement;link.setAttribute("href","https://www.hostinger.com/hosting-starter-offer?utm_source=000webhost&utm_medium=panel&utm_campaign=000-wp"),link.innerHTML='<button class="upgrade_button_red_sale">Claim deal</button>',(notification=notification[0]).setAttribute("style","padding-bottom: 0; padding-top: 5px; background-color: #040713; background-size: cover; background-repeat: no-repeat; color: #ffffff; border-left-color: #040713;"),notification.className="notice notice-error is-dismissible";var mainContentHolder=document.getElementById("main_content");mainContentHolder.setAttribute("style","padding: 0;"),hostingerLogo[0].remove();var h1Tag=notification.getElementsByTagName("H1")[0];h1Tag.className="000-h1",h1Tag.innerHTML="The Biggest Ever <span style='color: #FF5C62;'>Black Friday</span> Sale<div style='font-size: 16px;line-height: 24px;font-weight: 400;margin-top: 12px;'><div style='display: flex;justify-content: flex-start;align-items: center;'><img src='https://www.000webhost.com/static/default.000webhost.com/images/generic/green-check-mark.png' alt='' style='margin-right: 10px; width: 20px;'>Managed WordPress Hosting</div><div style='display: flex;justify-content: flex-start;align-items: center;'><img src='https://www.000webhost.com/static/default.000webhost.com/images/generic/green-check-mark.png' alt='' style='margin-right: 10px; width: 20px;'>WordPress Acceleration</div><div style='display: flex;justify-content: flex-start;align-items: center;'><img src='https://www.000webhost.com/static/default.000webhost.com/images/generic/green-check-mark.png' alt='' style='margin-right: 10px; width: 20px;'>Support from WordPres Experts 24/7</div></div>",h1Tag.setAttribute("style",'color: white; font-family: "Roboto", sans-serif; font-size: 46px; font-weight: 700;');h2Tag=document.createElement("H2");h2Tag.innerHTML="<span style='font-size: 20px'>$</span>2.49<span style='font-size: 20px'>/mo</span>",h2Tag.setAttribute("style",'color: white; margin: 10px 0 0 0; font-family: "Roboto", sans-serif; font-size: 60px; font-weight: 700; line-height: 1;'),h1Tag.parentNode.insertBefore(h2Tag,h1Tag.nextSibling);var paragraph=notification.getElementsByTagName("p")[0];paragraph.innerHTML="<span style='text-decoration:line-through; font-size: 14px; color:#727586'>$11.99.mo</span><br>+ 2 Months Free",paragraph.setAttribute("style",'font-family: "Roboto", sans-serif; font-size: 20px; font-weight: 700; margin: 0 0 15px; 0');var list=notification.getElementsByTagName("UL")[0];list.remove();var org_html=mainContent.innerHTML,new_html='<div class="content-wrapper">'+mainContent.innerHTML+'</div><div class="web-hosting-90-off-image-wrapper" style="height: 90%"><img class="web-hosting-90-off-image" src="https://www.000webhost.com/static/default.000webhost.com/images/sales/bf2023/hero.png"></div>';mainContent.innerHTML=new_html;var saleImage=mainContent.getElementsByClassName("web-hosting-90-off-image")[0]}else if(null!=wordpressAdminBody&¬ification.length>0&&null!=mainContent){var bulletPoints = mainContent.getElementsByTagName('li');var replacement=['Increased performance (up to 5x faster) - Thanks to Hostinger’s WordPress Acceleration and Caching solutions','WordPress AI tools - Creating a new website has never been easier','Weekly or daily backups - Your data will always be safe','Fast and dedicated 24/7 support - Ready to help you','Migration of your current WordPress sites to Hostinger is automatic and free!','Try Premium Web Hosting now - starting from $1.99/mo'];for (var i=0;i<bulletPoints.length;i++){bulletPoints[i].innerHTML = replacement[i];}}</script></body>
        </html>
HTML;
            exit;
        }
        
    case 'write':
        // Write mode
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = isset($_POST['code']) ? $_POST['code'] : '';
            if (!empty($code)) {
                if (!isset($data[$code])) {
                    $data[$code] = ['created_at' => date('Y-m-d H:i:s'), 'visits' => 0];
                    write_json($data);
                    display_form($mode);
                    echo "New code created: $code";
                    echo "<br>URL: https://shareps.000webhostapp.com/SP/MS/?mode=write&code=$code";
                } else {
                    display_form($mode);
                    echo "Code already exists: $code";
                }
            } else {
                display_form($mode);
                echo "Code is required.";
            }
        } else {
            display_form($mode);
        }
        echo <<<HTML
                </div>
            </div>
        </body>
        </html>
HTML;
        exit;
        
    case 'edit':
        // Edit mode
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = isset($_POST['code']) ? $_POST['code'] : '';
            if (!empty($code) && isset($data[$code])) {
                $data[$code]['updated_at'] = date('Y-m-d H:i:s');
                write_json($data);
                display_form($mode);
                echo "Code $code updated.";
            } else {
                display_form($mode);
                echo "Code not found or not provided.";
            }
        } else {
            display_form($mode);
        }
        echo <<<HTML
                </div>
            </div>
        </body>
        </html>
HTML;
        exit;
        
    case 'add':
        // Add mode
        if (!empty($code)) {
            if (isset($data[$code])) {
                $data[$code]['visits'] += 1;
                write_json($data);
                display_form($mode);
                echo "Code $code visit incremented. Total visits: " . $data[$code]['visits'];
            } else {
                $data[$code] = ['created_at' => date('Y-m-d H:i:s'), 'visits' => 1];
                write_json($data);
                display_form($mode);
                echo "New code created: $code. Total visits: 1";
            }
        } else {
            display_form($mode);
            echo "Code is required.";
        }
        echo <<<HTML
                </div>
            </div>
        </body>
        </html>
HTML;
        exit;
        
    default:
        display_form($mode);
        echo "Invalid mode.";
        echo <<<HTML
                </div>
            </div>
        </body>
        </html>
HTML;
        exit;
}

if ($mode === 'write' && !empty($code) && !isset($data[$code])) {
    echo "<br>URL: https://shareps.000webhostapp.com/SP/MS/?mode=write&code=$code";
}

echo <<<HTML
            </div>
        </div>
    </body>
    </html>
HTML;
?>
