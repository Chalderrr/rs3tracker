<template>
    <div v-if="!result">

        <div class="search">
            <div class="field" >
                <label class="label">Search for a Player</label>
                <div class="control">
                    <input class="input" name="search" type="search" placeholder="Search..." v-model="search">
                </div>
            </div>

        <!-- only call `vm.submit()` when the `key` is `Enter`
        <input v-on:keyup.enter="submit"> -->

                <div class="control">
                    <button @click="submit" v-on:keyup.enter="submit" class="button is-link">Search</button>
                </div>
                <div class="control">
                    <button class="button is-link is-light" @click="reset">Reset</button>
                </div>
        </div>

    </div>

    <div v-else>
        <div class="result">
            {{ result.combat }}

            <!-- <ul>
                <li v-for="skill in skills">
                    <p><strong>{{skill.name}}:</strong> {{skill.level}} <small><strong>(Virtual Level:)</strong>{{ skill.virtualLevel }}</small></p>
                </li>
            </ul> -->
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            search: '',
            errors: null,
            result: null,
            skills: null,
            rsn: null,
            rank: null,
            totalLevel: null,
            totalXp: null,
            activities: null,
            combat: null,
        }
    },
    methods: {
        reset() {
            this.result = null;
        },
        submit () {
            var vm = this;

            axios.post('/search', {
                search: this.search,
            })
            .then(response => {
                vm.result = response.data;
                // vm.skills = response.data.skills;
                // vm.combat = response.data.combat;
                // vm.rank = response.data.rank;
                // vm.totalLevel = response.data.totalLevel;
                // vm.totalXp = reponse.data.totalXp;
                // vm.activities = response.data.activities;
                vm.player = response.data;
            })
            .catch(error => {
                vm.errors = error.response.data.errors;
            });
        }
    }

}
</script>