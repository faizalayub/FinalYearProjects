<template>
    <div class="row g-0">

        <!-- USERS -->
        <div class="border-end list-group col-12 col-lg-5 col-xl-3">
            <a 
                v-for="(data, index) in conversationPeople"
                :key="index"
                href="#"
                @click="(currentConversation = data.id)"
                class="list-group-item list-group-item-action border-0">
            
                <div class="d-flex align-items-start">
                    <div class="flex-grow-1 ms-3">
                        {{ data.name }}
                        <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                    </div>
                </div>
            </a>
            <hr class="d-block d-lg-none mt-1 mb-0">
        </div>

        <!-- CONVERSATION -->
        <div class="border-end list-group col-12 col-lg-7 col-xl-9">
            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                <div class="d-flex align-items-center py-1">
                    <div class="flex-grow-1 ps-3">

                        <template v-if="peopleChatProfile">
                            <strong>{{ peopleChatProfile.name || '-' }}</strong>
                            <div class="text-muted small"><em>Online</em></div>
                        </template>

                        <template v-else>
                            <strong>No Person</strong>
                        </template>

                    </div>
                </div>
            </div>

            <div class="position-relative">
                <div class="chat-messages p-4">

                    <!-- Yes Conversation -->
                    <template v-for="(data, index) in conversation" :key="index">
                        <div v-if="(data.position == 'right')" class="chat-message-right pb-4">
                            <div>
                                <img :src="usericon" class="rounded-circle me-1" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">{{ data.time }}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">
                                <div class="font-weight-bold mb-1">You</div>{{ data.text }}</div>
                        </div>

                        <div v-if="(data.position == 'left')" class="chat-message-left pb-4">
                            <div>
                                <img :src="usericon" class="rounded-circle me-1" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">{{ data.time }}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ms-3">
                                <div class="font-weight-bold mb-1">{{ peopleChatProfile.name || '-' }}</div>{{ data.text }}
                            </div>
                        </div>
                    </template>

                    <!-- No Conversation -->
                    <div
                        v-if="(conversation.length == 0)"
                        v-html="'No conversation yet'"
                        class="w-100 bg-light p-2 text-center text-mute d-flex align-items-center justify-content-center"
                        :style="{ height: '50vh' }">
                    </div>

                </div>
            </div>

            <div class="flex-grow-0 py-3 px-4 border-top">
                <div class="input-group">
                    <input v-model="chatInput" @keyup.enter="submitChat" type="text" class="form-control" placeholder="Type your message">
                    <button @click="submitChat" class="btn btn-primary">Send</button>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import $ from 'jquery';
import moment from 'moment';

export default {
    name: 'dashboard',
    data: () => ({
        responsePeople: [],
        responseChat: [],
        currentConversation: null,
        currentProfile: null,
        chatInput: null,
        usericon: 'img/user.png',
    }),
    methods: {
        submitChat: function(){
            const self = this;
            const config = {
                url: `./_chat.php`,
                method: "POST",
                data: {
                    function: 'save',
                    to: this.currentConversation,
                    from: this.currentProfile,
                    message: this.chatInput,
                },
                success: function(e){
                    self.refreshChat();
                    self.chatInput = null;
                }
            };

            return $.ajax(config);
        },
        refreshChat: function(){
            const self = this;
            const config = {
                url: `./_chat.php`,
                method: "POST",
                data: {
                    function: 'getchats',
                    to: this.currentProfile,
                    from: self.currentConversation,
                },
                success: function(jsonstring){
                    const data = (self.IsValidJSONString(jsonstring) ? JSON.parse(jsonstring) : jsonstring);

                    self.responseChat = data;
                }
            };

            return $.ajax(config);
        },
        refreshUserList: function(){
            const self = this;

            return new Promise(resolve => {
                $.ajax({
                    url: `./_chat.php`,
                    method: "POST",
                    data: {
                        function: 'getusers',
                    },
                    success: function(jsonstring){
                        const data = (self.IsValidJSONString(jsonstring) ? JSON.parse(jsonstring) : jsonstring);

                        resolve(data && data.length > 0 ? data : []);
                    }
                });
            });
        },
        IsValidJSONString: function (str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
    },
    computed: {
        peopleChatProfile: function(){
            return this.responsePeople.find(c => c.id == this.currentConversation);
        },
        currentAccountType: function(){
            return (window.location.pathname.includes('admin') ? 'admin' : 'user');
        },
        conversationPeople: function(){
            if(this.currentAccountType == 'admin'){
                return this.responsePeople.filter(c => c.type == 2);
            }

            if(this.currentAccountType == 'user'){
                return this.responsePeople.filter(c => c.type == 1);
            }
        },
        conversation: function(){
            return this.responseChat.map(c => ({
                text: (c.message),
                position: (this.currentProfile == c.user_id ? 'right' : 'left'),
                time: moment(c.created_date, 'YYYY-MM-DD HH:mm:ss').format('DD MMMM YYYY hh:mm A')
            }))
        }
    },
    watch: {
        currentConversation: function(){
            this.refreshChat();
        }
    },
    mounted: async function(){
        const userdata = await this.refreshUserList();

        this.responsePeople = userdata;

        this.currentConversation = this.conversationPeople[0].id;
        
        this.currentProfile = myProfileID;
    }
}
</script>
  