function setVideoStats(txt,vd,idexp){
    var baseUrlApi = window.location.origin;
    $("#data-container").empty();
    $("#sent-container").empty();
    $("#concord-container").empty();
    const newcentence = txt;
    $.ajax({
        type: 'POST',
        url: baseUrlApi+"/portail-stagiaire/labo/newtestapi.php",
        data:JSON.stringify({idexp:idexp,sentence:txt}),
        dataType: "json"    
    }).done(function(res) {
            console.log(JSON.stringify({res}));
            var nbWordsValue = res[1].stats_nbwords;
            var nbHapax = res[5].stats_nbhapax;
            var nbadj = res[3].stats_nbadj;
            var nbvb = res[4].stats_nbverb;
            var nbact = res[6].stats_nbact;
            var nbpass = res[6].stats_nbpass;
            $("#id-words").text(nbWordsValue);
            $("#id-hapax").text(nbHapax);
            $("#id-verbs").text(nbvb);
            $("#id-adj").text(nbadj);
            $("#id-act").text(nbact);
            $("#id-pass").text(nbpass);
            var temps = vd.split(":");
            var heures = parseInt(temps[0], 10);
            var minutes = parseInt(temps[1], 10);
            var secondes = parseInt(temps[2], 10);
            // Calculer le temps total en secondes
            var tempsTotal = (heures * 3600) + (minutes * 60) + secondes;
            var debits = res[2].stats_debits;
            $("#id-debits").text(debits+" words/sec");
            console.log("nbwords recuperé: "+nbWordsValue);
            var presentList = $("<ul>");
            $.each(res[8].conjugaison_presentVerb, function(index, value) {
                presentList.append($("<li>").text(value));
            });
            var pastList = $("<ul>");
            $.each(res[8].conjugaison_pastVerb, function(index, value) {
                pastList.append($("<li>").text(value));
            });
            var preteritList = $("<ul>");
            $.each(res[8].conjugaison_pastParticipe, function(index, value) {
                preteritList.append($("<li>").text(value));
            });
            var ingList = $("<ul>");
            $.each(res[8].conjugaison_ingVerb, function(index, value) {
                ingList.append($("<li>").text(value));
            });
            var modalList = $("<ul>");
            $.each(res[8].conjugaison_modalVerb, function(index, value) {
                modalList.append($("<li>").text(value));
            });
            var passlist = $("<ul>");
            $.each(res[6].phrase_passive, function(index, value) {
                passlist.append($("<li>").text(value));
            });
            var actlist = $("<ul>");
            $.each(res[6].phrase_active, function(index, value) {
                actlist.append($("<li>").text(value));
            });

            var adjList = $("<ul>");
            $.each(res[3].glossaire_adjectivs, function(index, value) {
              adjList.append($("<li>").text(value));
            });
      
            var vbList = $("<ul>");
            $.each(res[4].glossaire_verbs, function(index, value) {
              vbList.append($("<li>").text(value));
            });
      
            var hapaxesList = $("<ul>");
            $.each(res[5].glossaire_hapaxes, function(index, value) {
              hapaxesList.append($("<li>").text(value));
            });

            window.global_hapaxesList = hapaxesList;
            // console.log(global_hapaxesList);
            window.global_vbList = vbList;
            window.global_adjList = adjList;
            window.global_actList = actlist;
            window.global_passList = passlist;
            window.global_pastList = pastList;
            window.global_presentList= presentList;
            window.global_modalList = modalList;
            window.global_inglList = ingList;
            window.global_preteritList = preteritList;

            // Ajouter les éléments HTML au conteneur
            $("#data-container").append(
                $("<div>").append(
                    $("<h3>").text("Hapaxes:"),
                    hapaxesList
                ),
                $("<div>").append(
                    $("<h3>").text("Adjectives:"),
                    adjList
                ),
                $("<div>").append(
                    $("<h3>").text("Verbs:"),
                    vbList
                )
            );
            $("#sent-container").append(
                $("<div>").addClass("row").append(
                    $("<div>").addClass("col").append(
                        $("<h3>").text("actives:"),
                        actlist
                    ),
                    $("<div>").addClass("col").append(
                        $("<h3>").text("passives:"),
                        passlist
                    )
                )
            );
            $("#conjugaison-container").append(
                $("<div>").addClass("row").append(
                    $("<div>").addClass("col").append(
                        $("<h3>").text("Present:"),
                        presentList
                    ),
                    $("<div>").addClass("col").append(
                        $("<h3>").text("Past:"),
                        pastList
                    ),
                    $("<div>").addClass("col").append(
                        $("<h3>").text("Preterit:"),
                        preteritList
                    ),
                    $("<div>").addClass("col").append(
                        $("<h3>").text("verbe ING:"),
                        ingList
                    ),
                    $("<div>").addClass("col").append(
                        $("<h3>").text("Modal verb"),
                        modalList
                    )
                )
            );
        });
  }

  export default setVideoStats;