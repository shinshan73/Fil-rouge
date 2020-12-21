console.log("lol")

const qcm = {
                title: "Une réponse a chaque question !",
                question: [
                    { 
                    questionTitre: "Question 1, Scream est dans quelle équipe ?",
                    reponse: [
                        {
                            choix: "A  FPX",
                            isRight: false,
                        },
                        {
                            choix: "B LIQUID",
                            isRight: true,
                        },
                        {
                            choix: "C BONK",
                            isRight: false,
                        },
                        {
                            choix: "D G2",
                            isRight: false,
                        },
                    ],
                    },
                    {
                    questionTitre: "Question 2, Quelle équipe est au rank 1 ?",
                    reponse: [
                        {
                            choix: "A G2",
                            isRight: true,
                        },
                        {
                            choix: "B BONK",
                            isRight: false,
                        },
                        {
                            choix: "C LIQUID",
                            isRight: false,
                        },
                        {
                            choix: "D FPX",
                            isRight: false,
                        },
                    ],
                    },
                    {
                    questionTitre: "Question 3, La date de sortie initiale ?",
                    reponse: [
                        {
                            choix: "A 2/06/2020",
                            isRight: true,
                        },
                        {
                            choix: "B 15/02/2020",
                            isRight: false,
                        },
                        {
                            choix: "C 5/09/2020",
                            isRight: false,
                        },
                        {
                            choix: "D 25/10/2020",
                            isRight: false,
                        },
                    ],
                    },
                    {
                    questionTitre: "Question 4, Quelle équipe est une équipe Suède ?",
                    reponse: [
                        {
                            choix: "A FPX",
                            isRight: false,
                        },
                        {
                            choix: "B LIQUID",
                            isRight: false,
                        },
                        {
                            choix: "C G2",
                            isRight: false,
                        },
                        {
                            choix: "D BONK",
                            isRight: true,
                        },  

                    ],
                    
                }],
            };

            let score = 0;
            let index_question = 0;
            let index_answer = 0;

            window.onload = afficherPage;

            function afficherPage(){
                if(index_question < qcm.question.length){
                    document.getElementById("title").innerHTML = afficherSujet();
                    document.getElementById("question").innerHTML = afficherQuestion();
                    document.getElementById("r1").innerHTML = afficherReponse(0);
                    document.getElementById("r2").innerHTML = afficherReponse(1);
                    document.getElementById("r3").innerHTML = afficherReponse(2);
                    document.getElementById("r4").innerHTML = afficherReponse(3);
                }
                else{
                    document.getElementById("question").innerHTML = "Le QCM est finis ! Vous avez gagner   : " + score + " Points !";
                    document.getElementById("r1").innerHTML = null;
                    document.getElementById("r2").innerHTML = null;
                    document.getElementById("r3").innerHTML = null;
                    document.getElementById("r4").innerHTML = null;
                
                }
            }

            function afficherSujet(){
                return qcm.title;
            }

            function afficherQuestion(){
                return qcm.question[index_question].questionTitre;
            }

            function afficherReponse(index){
                return qcm.question[index_question].reponse[index].choix;
            }

            function testAnswer(reponse){
                console.log("alo");
                if(qcm.question[index_question].reponse[reponse].isRight){
                    alert("Bien joué ! ");
                    score++;
                }
                else{
                    alert("Dommage ! ce n'est pas la bonne réponse, la réponse était " + qcm.question[index_question].reponse.find(a => a.isRight === true).choix);
                }
                index_question++;
                afficherPage();
            }
