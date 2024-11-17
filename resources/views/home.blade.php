<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Result</title>
</head>
<body>
    <div class="container">    
        <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Your API key</div>
                </div>  
                <div class="panel-body">
                    <p>Your API Key:</p>
                    <div id="token-display" class="alert alert-info"></div>
                    <button id="copy-button" class="btn btn-primary">Copy API Key</button> 
                </div>
                <div class="panel-body">
                    <p>Your API URL:</p>
                    <p id="api-url" class="alert alert-info">{{ env('APP_URL') }}/api/api/weather/{city_name}</p>
                    <button id="copy-button2" class="btn btn-primary">Copy API URL</button> 
                </div>
            </div>
        </div> 
    </div>

    <!-- JavaScript code should be here, at the end of the body -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Retrieve the token from localStorage
            const token = localStorage.getItem('token');

            // Display the token in the page
            if (token) {
                document.getElementById('token-display').innerText = token;
            } else {
                alert('No token found. Please log in again.');
                window.location.href = '/';
            }
        });
        document.getElementById('copy-button').addEventListener('click', () => {
                const token = document.getElementById('token-display').innerText;
                
                if (token) {
                    // Create a temporary text area element to select and copy the token
                    const textarea = document.createElement('textarea');
                    textarea.value = token;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);
                    
                    // Optionally, show an alert that the token was copied
                    alert('API Key copied to clipboard!');
                }
            });
            document.getElementById('copy-button2').addEventListener('click', () => {
                const token = document.getElementById('api-url').innerText;
                
                if (token) {
                    // Create a temporary text area element to select and copy the token
                    const textarea = document.createElement('textarea');
                    textarea.value = token;
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);
                    
                    // Optionally, show an alert that the token was copied
                    alert('API URL copied to clipboard!');
                }
            });
      
      
    </script>
</body>
</html>
