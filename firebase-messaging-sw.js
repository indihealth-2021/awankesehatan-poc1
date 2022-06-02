importScripts('https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.16.0/firebase-messaging.js');

firebase.initializeApp({
        "apiKey": "AIzaSyD936QRnRMkq02IgQ1kMg5ZYB1hEcuTwUM",
        "authDomain": "telehealth-6a164.firebaseapp.com",
        "databaseURL": "https://telehealth-6a164.firebaseio.com",
        "projectId": "telehealth-6a164",
        "storageBucket": "telehealth-6a164.appspot.com",
        "messagingSenderId": "513400070049",
        "appId": "1:513400070049:web:7da9b8978395a153a875e0"
 
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/itwonders-web-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});
 