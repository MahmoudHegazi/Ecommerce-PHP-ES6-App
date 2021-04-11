window.addEventListener('DOMContentLoaded', (event) => {




    var duration_valid = false;
    /* notification */
    const notifcation_container = document.querySelector("#notifcation");
    const notifcation_message = document.querySelector("#message0");
    const close_btn = document.querySelector("#close1");



    /* Task Globals */
    const app_task_form = document.querySelector("#task_formid");
    const app_task_name = document.querySelector("#taskname");
    const app_task_duration = document.querySelector("#duration");
    const app_task_start = document.querySelector("#start_date");
    const app_task_finish = document.querySelector("#finish_date");


    /* Resource Globals */
    const app_resource_form = document.querySelector("#resource_formid");
    const app_resource_name = document.querySelector("#resource_name");
    const app_resource_type = document.querySelector("#type");
    const app_resource_meterial = document.querySelector("#meterial");
    const app_resource_rate = document.querySelector("#st_rate");
    const app_resource_ovt = document.querySelector("#ovt");
    const app_resource_use = document.querySelector("#cost");

   // function to add effect when hide the alert
    var fadeout_tasks = function( element ) { // 1
        element.style.opacity = 1; // 2
        let hidden_process = window.setInterval(function() { // 3
            if(element.style.opacity > 0) { // 4
                element.style.opacity = parseFloat(element.style.opacity - 0.01).toFixed(2); // 5
            } else {
                element.style.display = 'none'; // 6
                console.log('1');
                clearInterval(hidden_process);
            }
        }, 100);


    };

    const fadeout_task_fast = function( element ) { // 1
        element.style.opacity = 1; // 2
        let hidden_process = window.setInterval(function() { // 3
            if(element.style.opacity > 0) { // 4
                element.style.opacity = parseFloat(element.style.opacity - 0.01).toFixed(2); // 5
            } else {
                element.style.display = 'none'; // 6
                console.log('1');
                clearInterval(hidden_process);
            }
        }, 8);


    };


    // Set the start date min to today
    const generate_date_string = ()=> {
      let now = new Date();
      let month = now.getMonth() + 1;
      let year = now.getFullYear();
      let day = now.getDate();
      if (day <= 9) {
         day = 0 + '' + day;
      }
      if (month <= 9) {
         month = 0 + '' + month;
      }
      let date_string = year + '-' + month  + '-' + day;
      return date_string;
    }

    // function to handle select end date dynamic
    const return_input_date = (start_date,duration)=> {
        let chooseDate=new Date(start_date);
        chooseDate.setDate(chooseDate.getDate()+parseInt(duration));
        let month = chooseDate.getMonth() + 1;
        let year = chooseDate.getFullYear();
        let day = chooseDate.getDate();
        if (day <= 9) {
           day = 0 + '' + chooseDate.getDate();
        }
        if (month <= 9) {
           month = 0 + '' + month;
        }
        let finish_date_value = year + '-' + month  + '-' + day;
        return finish_date_value;
    }


    let today_date = generate_date_string();
    app_task_start.value = today_date;
    app_task_finish.value = return_input_date(today_date, 1);
    app_task_start.setAttribute('min', today_date);
    app_task_finish.setAttribute('min', today_date);

    /* Post Data Function Async */
    const postData = async(url = '', data = {}) => {

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
    const getData = async (url)=> {
      const request = await fetch(url);
      try{
         const response = await request.json();
         alert(response.main.temp);
      } catch( error ) {
         alert(error);
      }
    }


    /* show error function */
    const hideMessage = ()=> {
      fadeout_tasks(notifcation_container);
    }

    /* show error function */
    const closeMessage = ()=> {
      fadeout_task_fast(notifcation_container);
    }


    /* show error function */
    const showMessage = (message, color)=> {
      notifcation_container.style.display="block";
      setTimeout(function(){ notifcation_container.style.background= color; }, 200);
      setTimeout(function(){ notifcation_container.style.background= 'yellow'; }, 600);
      setTimeout(function(){ notifcation_container.style.background= color; }, 1000);
      setTimeout(function(){ notifcation_container.style.background= 'yellow'; }, 2000);
      notifcation_message.innerText = message;
    }


    close_btn.addEventListener( "click" , closeMessage);




  // when start date selected and duration get the finish

  app_task_start.addEventListener('change', ()=> {

    if (app_task_duration.value > 0) {
       app_task_finish.value = return_input_date(app_task_start.value, app_task_duration.value);
       duration_valid = true;
       hideMessage();
       return true;
     } else {
       duration_valid = false;
       showMessage('Please enter A valid duration', 'tomato');
       return false;
     }
  });


const validate_duration =  ()=> {

    if (parseInt(app_task_duration.value) > 0) {
       app_task_finish.value = return_input_date(app_task_start.value, app_task_duration.value);
       duration_valid = true;
       hideMessage();
       return true;
     } else {
       duration_valid = false;


       showMessage('Please enter A valid duration', 'tomato');
       return false;
     }
  }
 // if user changed the duration after select a date show updated end date (More UX)
  app_task_duration.addEventListener('input', validate_duration);
 //app_task_name, app_task_duration, app_task_start, app_task_finish

  const taskform_function = async (event) => {


    event.preventDefault();
    hideMessage();
    // sent async request to post the new task  taskname duration sdate fdate


    checkduration = validate_duration();
    if (checkduration == true){
      hideMessage();
      duration_valid == true;
    } else {
      duration_valid == false;
    }

    if (duration_valid == false){
      showMessage('Please enter A valid duration', 'tomato');
      return false;
    }

    postData('inc/tasks.php',{
      taskname: app_task_name.value,
      duration: app_task_duration.value,
      start_date: app_task_start.value,
      finish_date: app_task_finish.value
    })
    .then((data)=>{
      // if data added and code 200 show sucess
      if (data) {

            if (data['code'] === 200){
              showMessage(data['message'], '#4CAF50');
            } else {
              console.log(data);
              showMessage(data['message'], 'tomato');
            }


        } else {
          console.log('Server Could Not Process The Request (Bad Request)');
        }
     })
    .catch((error) => console.log(error));
};
 app_task_form.addEventListener( "submit" , taskform_function);

    // showError("Welcome Message");
});
