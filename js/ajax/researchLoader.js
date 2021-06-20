function ResearchLoader() {}

ResearchLoader.loadData=function() {
    universita = document.getElementById('ajax_filled_uni').value;
    corsoDiLaurea = document.getElementById('ajax_filled_cdl').value;
    UniLoader.loadData(universita);
    CdlLoader.loadData(universita, corsoDiLaurea);
    TutorLoader.loadData(0, universita, corsoDiLaurea);
}


