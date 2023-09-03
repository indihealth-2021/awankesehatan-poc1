importScripts('https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.16.0/firebase-messaging.js');

firebase.initializeApp({


            apiKey: "AIzaSyBQVFzlB_hnd8Td48GuQSUbhV60DXENiRw",

            authDomain: "telemedicine-poc2.firebaseapp.com",

            databaseURL: "https://telemedicine-poc2-default-rtdb.asia-southeast1.firebasedatabase.app",

            projectId: "telemedicine-poc2",

            storageBucket: "telemedicine-poc2.appspot.com",

            messagingSenderId: "170641677475",

            appId: "1:170641677475:web:dbfdb8df11cb068ba27316",

            measurementId: "G-LHGYJ33LGE"

});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  var pyl = JSON.parse(payload.data.body);
  console.log('PYS',pyl)
  alert(pyl.name)
  const notificationTitle = pyl.keterangan;
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/itwonders-web-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});
 