
$(function () {
    const word_list = [];
    $(".saveWords").click(function () {
        if (word_list.length != 0) {
            score = findScore(word_list);
            $.ajax({
                type: 'POST',
                url: $('#word_submit').attr('save-action'),
                data: {
                    '_token': $('#word_submit').attr('token'),
                    'score': score,
                    'Words_list': word_list
                }, success: function (response) {
                    if (response.status == 200) {
                        alert("Congratulations! You are Score is  " + score);
                        window.location.reload()
                    } else{
                        alert(response.message);
                    }
                }
            });
        } else {
            alert("Please add altesat one Word")
        }
    });

    $(".saveEmployee").click(function () {
        var user_input = $('#words').val();
        var random_string = $('#random_string').val();
        if (user_input != '' && isAlphabetic(user_input)) {
            if (InpuctCharCheck(user_input, random_string)) {
                $.ajax({
                    type: 'POST',
                    url: $('#check_word').attr('save-action'),
                    data: {
                        '_token': $('#check_word').attr('token'),
                        'word': user_input,
                    }, success: function (response) {
                        if (response.status == 200) {
                            word_list.push(user_input);
                            removeCharFromString(user_input)
                            var list = document.getElementById('WordList');
                            list.innerHTML = '';
                            for (var i = 0; i < word_list.length; i++) {
                                var listItem = document.createElement('li');
                                listItem.textContent = word_list[i];
                                list.appendChild(listItem);
                            }
                            $('#words').val('');

                        } else if (response.status == 201) {
                            alert(user_input + "is not a valid Word, Please enter valid  words")
                        } else {
                            alert(response.message)
                        }
                    }


                });

            } else {
                alert("Please Enter valid  word  !!, Characters must contain the given string also  Word repetition is not allowed")

            }

        } else {

            alert("Please Enter Valid Word")

        }


    });

    //check the given string is alphabetic or not
    function isAlphabetic(str) {
        var regex = /^[a-zA-Z]+$/;
        return regex.test(str);
    }

    //function for finding score
    function findScore(word_array_list) {
        var score = 0
        for (var i = 0; i < word_array_list.length; i++) {
            var score = score + word_array_list[i].length

        }
        return score;
    }
    // remove used character from random string
    function removeCharFromString(input_value) {
        var newStr = $('#random_string').val();
        for (var i = 0; i < input_value.length; i++) {
            var charToRemove = input_value[i]
            newStr = newStr.toString().replace(charToRemove, '');
        }
        $('#random_string').val(newStr);
    }

    //function for check input character are include the randomstring
    function InpuctCharCheck(input_value, random_string) {
        for (var i = 0; i < input_value.length; i++) {
            if (random_string.includes(input_value[i])) {
            } else {
                return false;
            }
        }
        return true;
    }

});

