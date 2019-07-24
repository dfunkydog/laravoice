export default function(){
    const scheduledToggler = document.querySelector('input#is_scheduled');
    const scheduleOptions = document.querySelector('.js-make_scheduled_options');

    if(scheduledToggler && scheduleOptions){
        scheduledToggler.addEventListener('change', function(e){
            if(scheduledToggler.checked){
                scheduleOptions.classList.add('active');
           } else {
               scheduleOptions.classList.remove('active');
           }
        })
    }
}