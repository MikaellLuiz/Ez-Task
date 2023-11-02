function moveAbout(){
    var sections = document.querySelectorAll('.content');
    var homeSection = document.querySelector('.title');
    if (homeSection) {
      sections.forEach(function(section) {
        section.style.display = 'flex'; 
        homeSection.style.display = 'none'
      });
    };
  
  }