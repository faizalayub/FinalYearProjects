<template>
    <div class="row g-0">

        <div class="col-12 col-lg-5 col-xl-3 border-end list-group">
            <a 
            v-for="(data, index) in peopleCollection"
            :key="index"
            href="#"
            @click="(peopleSwitch = data.id)"
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

        <div class="col-12 col-lg-7 col-xl-9">
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

                    <div class="chat-message-right pb-4">
                        <div>
                            <img :src="usericon" class="rounded-circle me-1" alt="Chris Wood" width="40" height="40">
                            <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                        </div>
                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 me-3">
                            <div class="font-weight-bold mb-1">You</div>
                            Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                        </div>
                    </div>

                    <div class="chat-message-left pb-4">
                        <div>
                            <img :src="usericon" class="rounded-circle me-1" alt="Sharon Lessman" width="40" height="40">
                            <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                        </div>
                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ms-3">
                            <div class="font-weight-bold mb-1">Sharon Lessman</div>
                            Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                        </div>
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

export default {
    name: 'dashboard',
    data: () => ({
        peopleCollection: [],
        peopleSwitch: null,

        chatInput: null,
        usericon: 'img/user.png',
    }),
    methods: {
        submitChat: function(){
            $.ajax({
                url: `./_chat.php`,
                method: "POST",
                data: {
                    function: 'save',
                    to: 2,
                    from: 2,
                    message: this.chatInput,
                },
                success: function(e){
                    console.clear();
                    console.log(e);
                }
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
            return this.peopleCollection.find(c => c.id == this.peopleSwitch);
        }
    },
    mounted: function(){
        let self = this;

        $.ajax({
            url: `./_chat.php`,
            method: "POST",
            data: {
                function: 'getusers',
            },
            success: function(jsonstring){
                self.peopleCollection = (self.IsValidJSONString(jsonstring) ? JSON.parse(jsonstring) : jsonstring);
            }
        });
    }
}
</script>
  