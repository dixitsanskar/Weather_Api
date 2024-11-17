

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <title>Weather API - Login</title>
    <script>
    function handleLogin() {
        const email = document.getElementById('login-name').value;
        const password = document.getElementById('login-password').value;

        axios.post('/api/api/login', {
            email: email,
            password: password,
        })
        .then(response => {
            if (response.data.status) {
                localStorage.setItem('token', response.data.token);
                alert('Login successful!');
                window.location.href = '/home';
            } else {
                document.getElementById('login-alert').style.display = 'block';
                document.getElementById('login-alert').innerText = response.data.message;
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById('login-alert').style.display = 'block';
            document.getElementById('login-alert').innerText = 'Login failed. Please check your credentials.';
        });
    }
    function handleRegister() {
        const email = document.getElementById('sign-email').value;
        const password = document.getElementById('sign-password').value;
        const name = document.getElementById('sign-name').value;

        axios.post('/api/api/register', {
            email: email,
            password: password,
            name: name
        })
        .then(response => {
            if (response.data.status) {
                localStorage.setItem('token', response.data.token);

                alert('Registered successful!');
                window.location.href = '/home';
            } else {
                document.getElementById('signuplert').style.display = 'block';
                document.getElementById('signupalert').innerText = response.data.message;
            }
        })
        .catch(error => {
            console.error(error);
            document.getElementById('signupalert').style.display = 'block';
            document.getElementById('signupalert').innerText = 'Login failed. Please check your credentials.';
        });
    }
    
</script>
</head>
<body>

<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" >
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-name" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <button id="btn-login" type="button" class="btn btn-success" onclick="handleLogin()">Login  </button>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form" >
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" id="sign-email" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" id="sign-name" class="form-control" name="name" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" id="sign-password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
                                    
                               

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                    <button id="btn-login" type="button" class="btn btn-success" onclick="handleRegister()">Sign Up </button>
                                    </div>
                                
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
</div>
</body>
</html>