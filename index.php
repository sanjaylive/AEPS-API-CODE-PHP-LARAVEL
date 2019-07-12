<script>
function getrdhashdata() {
            var device = $(".device:checked").val();
            var username = $("input#mobile_number").val();
            var dataString = 'mobile_number=' + username + "&device=" + device;
            $("#response").html("<img src='loader.png'>");
            $.ajax({
                type: "POST",
                url: "{{url('api/aeps/getrdhashdata')}}",
                data: dataString,
                dataType: "json",
                beforeSend: function () {

                },
                success: function (msg) {
                    console.log(msg);
                    alert(msg.RESP_CODE);
                    var pidOpt = msg.DATA.pidOpt;
                    var urlnew = msg.DATA.reqUrl;
                    Capture(pidOpt, urlnew);
                }

            });
        }

        function Capture(pidOpt, urlnew) {
            var xhr;//=createCORSRequest('CAPTURE',url);
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer, return version number
            {
//IE browser
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            } else {
//other browser
                xhr = new XMLHttpRequest();
            }
            alert(urlnew);
            xhr.open('CAPTURE', urlnew, true);
            xhr.setRequestHeader("Content-Type", "text/xml");
            xhr.setRequestHeader("Accept", "text/xml");
            if (!xhr) {
                toastr["success"]('Error for accessing device');
                console.log('CORS not supported');
                return
            }
// contentType: 'application/json; charset=utf-8',
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    var status = xhr.status;
                    if (status == 200) {
                        xhr.response
                        var device = $(".device:checked").val();
                        var username = $("input#mobile_number").val();
                        var aadhar_number = $("input#aadhar_number").val();
                        var name = $("input#name").val();
                        var amount = $("input#amount").val();
                        var transactiontype = "Balance";
                        var bankid = "607153";
                        var dataString = 'mobile_number=' + username + "&device=" + device + "&aadhaar_number=" + aadhar_number + "&name=" + name + "&bank_id=" + bankid + "&transactiontype=" + transactiontype + "&BiometricData=" + encodeURIComponent(xhr.response);
                        $("#response").html("<img src='loader.png'>");
                        $.ajax({
                            type: "POST",
                            url: "{{url('api/aeps/transaction')}}",
                            data: dataString,
                            dataType: "json",
                            beforeSend: function () {

                            },
                            success: function (msg) {
                                console.log(msg);
                            }

                        });
                    } else {
                        console.log(xhr.response);

                    }
                }
            };
            xhr.onerror = function () {
                console.log("Check If Morpho Service/Utility is Running");
            }
            xhr.send(pidOpt);
        }

        </script>