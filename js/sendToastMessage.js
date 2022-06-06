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

if(localStorage.getItem('idToast') == null) {
    localStorage.setItem('idToast', 0)
    new bootstrap.Toast(document.getElementById('toast' + localStorage.getItem('idToast'))).show()
}
if(toastElList.length > 0) {
  setupInterval(function () {
    // console.log(localStorage.getItem('idToast'));
    try {
      new bootstrap.Toast(document.getElementById('toast' + localStorage.getItem('idToast'))).show()
    } catch (error) {
      localStorage.setItem('idToast', '0');
    }
      if(localStorage.getItem('idToast') >= toastElList.length - 1) {
          localStorage.setItem('idToast', '0');
      } else {
          var indice = Number.parseInt(localStorage.getItem('idToast')) + 1;
          localStorage.setItem('idToast', indice.toString());
      }   
  }, 60000*1, 'toast')
}
