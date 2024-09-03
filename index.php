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
                    echo "<br>URL: https://sharepanel.host/dev/MS/?mode=write&code=$code";
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
    echo "<br>URL: https://sharepanel.host/dev/MS/?mode=write&code=$code";
}

echo <<<HTML
            </div>
        </div>
    </body>
    </html>
HTML;
?>
