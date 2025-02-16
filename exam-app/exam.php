<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="questions"></div>
    <div id="timer">Time Left: 10:00</div>
    <button id="submit">Submit Exam</button>

    <script>
        let timeLeft = 600; // 10 minutes in seconds

        $(document).ready(function() {
            // Fetch questions
            $.ajax({
                url: 'fetch_questions.php',
                method: 'GET',
                success: function(data) {
                    var questions = JSON.parse(data);
                    var html = '';
                    questions.forEach(function(question, index) {
                        html += `<div>
                            <p>${question.question_text}</p>
                            <input type="radio" name="q${question.id}" value="1"> ${question.option1}<br>
                            <input type="radio" name="q${question.id}" value="2"> ${question.option2}<br>
                            <input type="radio" name="q${question.id}" value="3"> ${question.option3}<br>
                            <input type="radio" name="q${question.id}" value="4"> ${question.option4}<br>
                        </div>`;
                    });
                    $('#questions').html(html);
                }
            });

            // Timer
            setInterval(() => {
                timeLeft--;
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                $('#timer').text(`Time Left: ${minutes}:${seconds.toString().padStart(2, '0')}`);
                if (timeLeft <= 0) {
                    alert('Time is up!');
                    submitExam();
                }
            }, 1000);

            // Submit exam
            $('#submit').click(function() {
                submitExam();
            });

            function submitExam() {
                var answers = [];
                $('input[type="radio"]:checked').each(function() {
                    answers.push({
                        questionId: $(this).attr('name').substring(1),
                        answer: $(this).val()
                    });
                });

                $.ajax({
                    url: 'submit_exam.php',
                    method: 'POST',
                    data: { answers: JSON.stringify(answers) },
                    success: function(response) {
                        alert('Exam submitted! Your score: ' + response);
                        window.location.href = 'dashboard.php';
                    }
                });
            }
        });
    </script>
</body>
</html>