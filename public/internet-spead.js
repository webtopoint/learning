setInterval(dd,1000);
var div = $('#internet-spead-tag').attr('html-class');

function dd(){
                        var arrTimes = [];
                        var i = 0; // start
                        var timesToTest = 5;
                        var tThreshold = 150; //ms
                        var testImage = "https://www.google.com/images/phd/px.gif"; // small image in your server
                        var dummyImage = new Image();
                        var isConnectedFast = false;
                        var connection = '';
                        
                        testLatency(function(avg){
                          connection = 'Your Connectin is ';
                          if(avg <= 200){
                              connection += ' Ok';
                          }
                          else if(avg <= 500) //224
                            connection +=  'Low';
                          else
                            connection +=  'Very Low';
                            
                            
                          isConnectedFast = (avg <= tThreshold);
                          /** output */
                         
                            $('.'+div).html("<span> Time: " + (avg.toFixed(2)) + "ms </span><span>" + ( connection ) + ".</span>" )
                       
                        });
                        
                        /** test and average time took to download image from server, called recursively timesToTest times */
                        function testLatency(cb) {
                          var tStart = new Date().getTime();
                          if (i<timesToTest-1) {
                            dummyImage.src = testImage + '?t=' + tStart;
                            
                            dummyImage.onload = function() {
                              var tEnd = new Date().getTime();
                              var tTimeTook = tEnd-tStart;
                              arrTimes[i] = tTimeTook;
                              testLatency(cb);
                              i++;
                            };
                          } else {
                            /** calculate average of array items then callback */
                            var sum = arrTimes.reduce(function(a, b) { return a + b; });
                            var avg = sum / arrTimes.length;
                            cb(avg);
                          }
                        }
                    }