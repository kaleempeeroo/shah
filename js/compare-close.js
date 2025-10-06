/*

1. Wait for the DOM to finish loading.
- Get the #yith-woocompare-preview-bar comparison modal popup.
- If we are on the cart page, remove it after 1 sec because YITH Compare reloads it if we
remove it at once when page loads.

2. Create a MutationObserver that watches any changes made to the DOM after loading.
We are using this because YITH Compare re injects the modal if we remove it after page loads.

-Check if we have a class of .compare-close-btn that can be clicked by user to close modal,
as it stays open as an overlay. We do this check so that it button is only added once after YITH plugin 
has finished.
- Create a button 'X'
- Add the class .compare-close-btn to it.
- If button is clicked, hide the modal bar by removing class .shown

*/

document.addEventListener("DOMContentLoaded", () => {
//const bar = document.getElementById("yith-woocompare-preview-bar");
  
       
   
//if (bar) {
    const observer = new MutationObserver(() => {
    const bar = document.getElementById("yith-woocompare-preview-bar");

    if (bar && !bar.querySelector(".compare-close-btn")) {
      const closeBtn = document.createElement("button");
      closeBtn.textContent = "×";
      closeBtn.className = "compare-close-btn";

      closeBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        bar.classList.remove("shown");
        bar.style.display = "none";
      });

      bar.appendChild(closeBtn);
      console.log("✅ Close button added to compare bar");
    }

    // remove the class only once else it might be trying to remove multiple times 
    // if the plugin is refreshing.
    
    if (window.location.pathname.includes("/cart") && bar.classList.contains("shown")) {
     // setTimeout(() => {
            if (bar) {
            bar.classList.remove("shown");
            console.log("Removed class:", bar.classList.value);
            }
    //   }, 1000); // waits 1 second to let YITH script run first

    }
      
  });

  // Observe the whole body for any DOM changes
  observer.observe(document.body, { childList: true, subtree: true });

  //}
    

});
