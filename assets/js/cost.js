
window.addEventListener('DOMContentLoaded', (event) => {


      /* notification */
      const notifcation_container1 = document.querySelector("#notifcation1");
      const notifcation_message1 = document.querySelector("#message1");
      const close_btn1 = document.querySelector("#close2");

      /* Resource Globals */
      const app_resource_form = document.querySelector("#resource_formid");
      const app_resource_name = document.querySelector("#resource_name");
      const app_resource_type = document.querySelector("#type");
      const app_resource_meterial = document.querySelector("#meterial");
      const app_resource_rate = document.querySelector("#st_rate");
      const app_resource_ovt = document.querySelector("#ovt");
      const app_resource_use = document.querySelector("#cost");

      // function to add effect when hide the alert
       const fadeout_cost = function( element ) { // 1
           element.style.opacity = 1; // 2
           let hidden_process = window.setInterval(function() { // 3
               if(element.style.opacity > 0) { // 4
                   element.style.opacity = parseFloat(element.style.opacity - 0.01).toFixed(2); // 5
               } else {
                   element.style.display = 'none'; // 6
                   console.log('1');
                   clearInterval(hidden_process);
               }
           }, 70);


       };

       const fadeout_cost_fast = function( element ) { // 1
           element.style.opacity = 1; // 2
           let hidden_process = window.setInterval(function() { // 3
               if(element.style.opacity > 0) { // 4
                   element.style.opacity = parseFloat(element.style.opacity - 0.01).toFixed(2); // 5
               } else {
                   element.style.display = 'none'; // 6
                   console.log('1');
                   clearInterval(hidden_process);
               }
           }, 3);


       };


  /* Post Data Function Async */
  const postCostData = async(url = '', data = {}) => {

    const response = await fetch(url, {
      method: 'POST',
      mode:    'cors',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
        'Accept':       'application/json'
      },
      // Body data type must match "Content-Type" header
      body: JSON.stringify(data),
    });

    try {
      const newData = await response.json();
      return newData;
    } catch (error) {
      console.log("error", error);
      return false;
    }
  }

  /* GET Data Function Async */
  const getCostData = async (url)=> {
    const request = await fetch(url);
    try{
       const response = await request.json();
       alert(response.main.temp);
    } catch( error ) {
       alert(error);
    }
  }


  /* show error function */
  const hideMessage1 = ()=> {
    fadeout_cost(notifcation_container1);
  }

  /* show error function */
  const closeMessage1 = ()=> {
    //notifcation_container1.style.display="";
    fadeout_cost_fast(notifcation_container1);
  }

  /* show error function */
  const showMessage1 = (message, color)=> {
    notifcation_container1.style.display="block";
    setTimeout(function(){ notifcation_container1.style.background= color; }, 200);
    setTimeout(function(){ notifcation_container1.style.background= 'yellow'; }, 600);
    setTimeout(function(){ notifcation_container1.style.background= color; }, 1200);
    setTimeout(function(){ notifcation_container1.style.background= 'yellow'; }, 2000);
    notifcation_message1.innerText = message;
  }

  close_btn1.addEventListener( "click" , hideMessage1);

// app_resource_form, app_resource_name, app_resource_type, app_resource_meterial, app_resource_rate, app_resource_use

  /* cost request  */

  const resource_function = async (event) => {

    event.preventDefault();
    hideMessage1();
    // sent async request to post the new task  taskname duration sdate fdate
    postCostData('inc/cost.php',{
      resource_name: app_resource_name.value,
      resource_type: app_resource_type.value,
      resource_material_max: app_resource_meterial.value,
      resource_rate: app_resource_rate.value,
      resource_ovt: app_resource_ovt.value,
      resource_use: app_resource_use.value
    })
    .then((data)=>{
      // if data added and code 200 show sucess
      if (data) {

            if (data['code'] === 200){
              showMessage1(data['message'], '#4CAF50');
              hideMessage1();
            } else {
              console.log(data);
              showMessage1(data['message'], 'tomato');
            }
        } else {

          showMessage1('Could not create the cost Check your input values', 'tomato');
          console.log('Server Could Not Process The Request (Bad Request)');
        }
     })
    .catch((error) => console.log(error));
};
 app_resource_form.addEventListener( "submit" , resource_function);

    // showError("Welcome Message");

});
