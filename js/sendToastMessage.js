function setupInterval(callback, interval, name) {
  var key = "_timeInMs_" + (name || "");
  var now = Date.now();
  var timeInMs = localStorage.getItem(key);
  var executeCallback = function () {
    localStorage.setItem(key, Date.now());
    callback();
  };
  if (timeInMs) {
    // User has visited
    var time = parseInt(timeInMs);
    var delta = now - time;
    if (delta > interval) {
      // User has been away longer than interval
      setInterval(executeCallback, interval);
    } else {
      // Execute callback when we reach the next interval
      setTimeout(function () {
        setInterval(executeCallback, interval);
        executeCallback();
      }, interval - delta);
    }
  } else {
    setInterval(executeCallback, interval);
  }
  localStorage.setItem(key, now);
}


const toastElList = document.querySelectorAll('.toast')
const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl))
if(localStorage.getItem('idToast') == null) {
    localStorage.setItem('idToast', 0)
    toastList[0].show();
}
if(toastList.length > 0) {
  setupInterval(function () {
    console.log(localStorage.getItem('idToast'));
      toastList[localStorage.getItem('idToast')].show();
      if(localStorage.getItem('idToast') >= toastList.length - 1) {
          localStorage.setItem('idToast', '0');
      } else {
          var indice = Number.parseInt(localStorage.getItem('idToast')) + 1;
          localStorage.setItem('idToast', indice.toString());
      }   
  }, 60000*3, 'toast')
}
