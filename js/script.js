let chatData = {
  userName: "",
  userId: 0,
  lastLogin: null,
  userPhoto: "",
  conversations: null,
  selectedContactsType: "primary",
  selectedChat: null,

  init: function () {
    chatData.loadUserData();
  },

  loadUserData: function () {
    $.getJSON("../assets/chatHistory.json", (data) => {
      this.userName = data.user.username;
      this.userId = data.user.id;
      this.lastLogin = new Date(data.user.last_login);
      this.userPhoto = data.user.photo;
      this.conversations = data.conversations;
    }).done(chatData.updateUserData);
  },

  updateUserData: function () {
    $("#userName").html(`<b>${chatData.userName}</b>`);
    chatData.updateConversationsList();
  },

  updateConversationsList: function () {
    for (let id in chatData.conversations) {
      $("#contactsList").append(`
            <li id=${id} class="contacts-list__contact">
                  <div class="contact__container">
                    <div class="contact__image"><span
                      class="glyphicon glyphicon-user"
                      aria-hidden="true"
                    ></span></div>
                    <div class="contact__name"><b>${
                      chatData.conversations[id].username
                    }</b></div>
                    <div class="contact__last-message"><p class="small activity__activity-status_text-styling">
                      ${
                        chatData.conversations[id].messages.length
                          ? chatData.conversations[id].messages[
                              chatData.conversations[id].messages.length - 1
                            ].message
                          : ""
                      }
                    </p></div>
                  </div>
                </li>
            `);
    }
    $("#contactsList").click(chatData.setSelectedChat);
  },

  setSelectedChat: function (event) {
    chatData.selectedChat = event.target.id;
    chatData.showContactData();
  },

  showContactData: function () {
    $("#currentContactName").html(
      `<b>${chatData.conversations[chatData.selectedChat].username}</b>`
    );
    $("#currentContactActivity").html(
      `Active: ${chatData.conversations[chatData.selectedChat].last_login}`
    );
    chatData.showConversation();
  },

  showConversation: function () {
    // console.log(chatData.selectedChat);
    $("#messageHistory").html("");
    for (let message of chatData.conversations[chatData.selectedChat]
      .messages) {
      $("#messageHistory").append(`
        <div class="message-history__message message__${
          message.sender == chatData.selectedChat ? "input" : "output"
        }">${message.message}</div>
        `);
    }
    $(".message-window__wrapper").scrollTop(
      $(".message-history__message:last-child")[0].offsetTop
    );
  },
};

$(document).ready(chatData.init);
