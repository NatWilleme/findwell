if(document.querySelector('.fadeInUp1') !=  null){
  // Create the observer
  const observer = new IntersectionObserver((entries) => {
    // Loop over the entries
    entries.forEach((entry) => {
      // If the element is visible
      if (entry.isIntersecting) {
        let arrayClass = Array.from(entry.target.classList);
        arrayClass.find((elem) => {
          if (elem.includes("fadeInUp")) {
            // Add the animation class
            entry.target.classList.add("fadeInUp-scroll");
          } else if (elem.includes("fadeInRight")) {
            // Add the animation class
            entry.target.classList.add("fadeInRight-scroll");
          } else if (elem.includes("fadeInLeft")) {
              // Add the animation class
              entry.target.classList.add("fadeInLeft-scroll");
          } else if (elem.includes("backInRight")) {
              // Add the animation class
              entry.target.classList.add("backInRight-scroll");
          } else if (elem.includes("backInLeft")) {
              // Add the animation class
              entry.target.classList.add("backInLeft-scroll");
          }
        });

        // else if(entry.target.classList.contains('fadeInRight')){
        //     // Add the animation class
        //     entry.target.classList.add("fadeInRight-scroll");
        // }
      }
    });
  });

  // Tell the observer which elements to track

  observer.observe(document.querySelector(".fadeInUp1"));
  observer.observe(document.querySelector(".fadeInUp2"));
  observer.observe(document.querySelector(".fadeInUp3"));
  observer.observe(document.querySelector(".fadeInUp4"));
  observer.observe(document.querySelector(".fadeInRight"));
  observer.observe(document.querySelector(".fadeInLeft"));
  observer.observe(document.querySelector(".backInLeft"));
  observer.observe(document.querySelector(".backInRight"));
}