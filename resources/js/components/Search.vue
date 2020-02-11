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
                    <p><strong>{{skill.name}}</strong> {{skill.level}}<small>  <strong>(Virtual Level:)</strong>{{ skill.virtualLevel }}</small></p>
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

            axios.post('/search', {
                search: this.search,
            })
            .then(response => {
                this.result = response.data;
                this.skills = response.data.skills;
                this.combat = response.data.combat;
                this.rank = response.data.rank;
                this.totalLevel = response.data.totalLevel;
                this.totalXp = reponse.data.totalXp;
            })
            .catch(error => {   
                this.errors = error.response.data.errors;
            });
        }
    }

}
</script>