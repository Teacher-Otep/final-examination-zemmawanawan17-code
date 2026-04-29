//fucntion to show selected section
function showSection(sectionID){

    const allSections = document.querySelectorAll('.content, .homecontent');

    // hide everything
    allSections.forEach(section => {
        section.style.display = 'none';
    });

    // show selected
    const active = document.getElementById(sectionID);
    if(active){
        active.style.display = 'block';
    }
}
    //initially, select all sections
    // use querySelectorAll for all sections with class content and homecontent
    const sections = document.querySelectorAll('.content');
    const homesection = document.querySelectorAll('.homecontent');

    //hide the resulting content sections using foreach
    sections.forEach(section => {
        section.style.display='none';
    });


    //select the section that would
    //be displayed when clicked
    const activeSection = document.getElementById(sectionID);
    if(activeSection){
        activeSection.style.display='block';
    }
}
function goHome(){
    const sections = document.querySelectorAll('.content');
    sections.forEach(section => section.style.display = 'none');

    document.getElementById('home').style.display = 'block';
}

//for the insertion success
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        const toast = document.getElementById('success-toast');
        toast.classList.remove('toast-hidden');
        
        // Hide it automatically after 3 seconds
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.classList.add('toast-hidden'), 500);
        }, 3000);

        // Clean the URL
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}
document.getElementById("clrbtn").addEventListener("click", function(){

document.getElementById("surname").value="";
document.getElementById("name").value="";
document.getElementById("middlename").value="";
document.getElementById("address").value="";
document.getElementById("contact").value="";

})