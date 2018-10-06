<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <style>
            #ajaxBusy{
                margin: 0px auto; /* left margin is half width of the div, to centre it */
                padding: 30px 10px 10px 10px;
                position: absolute;
                left: 30%;
                top: 225px;
                width: 500px;
                height: 150px;
                text-align: center;
                border-radius: 5px;
                background: #e8e8e8;
                border: 1px solid #CCCCCC;
            }
        </style>
    </head>
<body>
<div id="fb-root"></div>
<script>
    var appid = '374895866674241';
    window.fbAsyncInit = function() {
        FB.init({
            appId: appid,
            cookie: true,
            status: true,
            xfbml: true,
            oauth : true, // enables OAuth 2.0
            version : 'v2.9',
            frictionlessRequests : true
        });
    };

    (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());

    function connect_fb(){
        FB.login(function (response) {
            if (response.authResponse) {
                var access_token =   FB.getAuthResponse()['accessToken'];
                if(access_token==undefined) {
                    access_token=response.authResponse.accessToken;
                }

                $.ajax({
                    async:true,
                    url: "login_facebook.php",
                    dataType: "json",
                    type : "POST",
                    data: {
                        oauth_token:access_token
                    },
                    beforeSend: function (response) {
                        $('body').append('<div id="ajaxBusy"><p id="ajaxBusyMsg">Please wait...</p></div>');
                        //$("#ajaxBusy").show();
                    },
                    complete: function(){
                        $("#ajaxBusy").hide();
                    },
                    success: function () {
                        top.location.href = "#"
                    }
                });
            }
        }, { scope: 'email, public_profile, user_friends' });
    }
</script>

<p><a href="#" onclick="connect_fb();"><img src="http://www.agussaputra.com/images/facebook.jpg"></a></p>
</body>
</html>