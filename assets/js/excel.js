window.addEventListener('DOMContentLoaded', (event) => {

 const downloadbtn = document.querySelectorAll('.excelbtn');




/* Post Data Function Async */
const postDataExcel = async(url = '', data = {}) => {

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
    console.log(newData)
    return newData;
  } catch (error) {
    console.log("error", error);
    return false;
  }
}


/* GET Data Function Async */
const getDataExcel = async (url)=> {
  const request = await fetch(url);
  try{
     const response = await request.json();
  } catch( error ) {
     alert(error);
  }
}




const downloadfun = async (event)=> {

   let tasknumber =  event.target.getAttribute('data-task');
   let download_request = await postDataExcel('inc/downloadexcel.php',{'task':tasknumber});

};


downloadbtn.forEach( (btn)=> {
       btn.addEventListener('click', downloadfun);
});

});
