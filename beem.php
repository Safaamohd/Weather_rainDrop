<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThingSpeak Data</title>
    <style>
        /* Reset some default browser styles */
        body, h1, p {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F5F5F5;
            color: #333333;
            line-height: 1.6;
            min-height: 100vh;
        }

        header {
            background-color: #333333;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .content {
            margin: 0;
            padding: 0;
        }

        .iframe-container {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        iframe {
            width: 100%;
            height: 260px;
            border: none;
            display: block;
        }
    </style>
    <script>
        function checkOutput() {
            var iframe = document.getElementById('myIframe');
            var iframeContent = iframe.contentWindow.document.body.innerHTML;

            if (parseInt(iframeContent) >= 200) {
                <?php 
                    $api_key='b7e8d829b01dd7c6';
                    $secret_key = 'MGM4NWU2ZTQ3YTA5NWQ5MjE1YTYwODVlYTVmNGZkMjVkNTQ2YWFiNDVlZDcxYWMzNmUwYTlhMTc0YzA2MzI4ZQ';
                    
                    $postData = array(
                        'source_addr' => 'INFO',
                        'encoding'=>0,
                        'schedule_time' => '',
                        'message' => 'It is raining',
                        'recipients' => [array('recipient_id' => '1','dest_addr'=>'255772818324'),array('recipient_id' => '2','dest_addr'=>'255778695626')]
                    );
                    
                    $Url ='https://apisms.beem.africa/v1/send';
                    
                    $ch = curl_init($Url);
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt_array($ch, array(
                        CURLOPT_POST => TRUE,
                        CURLOPT_RETURNTRANSFER => TRUE,
                        CURLOPT_HTTPHEADER => array(
                            'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                            'Content-Type: application/json'
                        ),
                        CURLOPT_POSTFIELDS => json_encode($postData)
                    ));
                    
                    $response = curl_exec($ch);
                    
                    if($response === FALSE){
                            echo $response;
                    
                        die(curl_error($ch));
                    }
                    var_dump($response);   
                ?>
            }
            window.addEventListener('message', handleMessage, false);
        }
    </script>
</head>
<body>
    <header>
        <h1>ThingSpeak Data</h1>
    </header>
    <div class="container">
        <!-- Content for "Setting" -->
        <section id="setting">
            <h2>View IFrame</h2>
            <!-- Add your iframe for "Setting" here -->
            <div class="iframe-container">
                <iframe src="https://thingspeak.com/channels/2259630/widgets/704695"></iframe>
            </div>
        
        
        </section>
        
        <!-- Content for "View Charts" -->
        <section id="view-charts">
            <h2>View Charts</h2>
            <!-- Add your iframe for "View Charts" here -->
            <div class="iframe-container">
                <iframe src="https://thingspeak.com/channels/2259630/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line"></iframe>
            </div>
        </section>
    </div>
</body>
</html>
