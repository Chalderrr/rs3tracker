<template>
    <div>
        <form @submit.prevent="submit">

            <div class="field">
                <label class="label">Search for a Player</label>
                <div class="control">
                    <input class="input" name="search" type="search" placeholder="Search..." v-model="search">
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button @click="submit" class="button is-link">Search</button>
                </div>
                <div class="control">
                    <button class="button is-link is-light">Reset</button>
                </div>
            </div>     



            <strong>Output:</strong>
            {{result}}

            <ul>
                <li v-for="skill in skills">
                    <p><strong>{{skill.name}}:</strong> {{skill.level}} <small><strong>(Virtual Level:)</strong>{{ skill.virtualLevel }}</small></p>
                </li>
            </ul>

        </form>
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
            combat: null,
            rank: null,
            totalLevel: null,
            totalXp: null,
        }
    },
    methods: {
        submit () {
            var vm = this;

            axios.post('/search', {
                search: this.search,
            })
            .then(response => {
                vm.result = response.data;
                vm.skills = response.data.skills;
                vm.combat = response.data.combat;
                vm.rank = response.data.rank;
                vm.totalLevel = response.data.totalLevel;
                vm.totalXp = reponse.data.totalXp;
            })
            .catch(error => {   
                vm.errors = error.response.data.errors;
            });
        }
    }

}
</script>