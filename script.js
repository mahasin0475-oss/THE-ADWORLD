async function sendMsg(){
    let input = document.getElementById("userInput");
    let text = input.value.trim();
    if(text==="") return;

    let messages = document.getElementById("messages");
    messages.innerHTML += `<div class="msg user">${text}</div>`;
    input.value = "";

    messages.innerHTML += `<div class="msg bot">Typing...</div>`;
    messages.scrollTop = messages.scrollHeight;

    const res = await fetch("chat.php",{
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify({message:text})
    });

    const data = await res.json();
    let reply = data.choices[0].message.content;

    messages.lastChild.innerHTML = reply;
    messages.scrollTop = messages.scrollHeight;
}

function quickAsk(text){
    document.getElementById("userInput").value = text;
    sendMsg();
}
