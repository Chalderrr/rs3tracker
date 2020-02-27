<template>
    <div v-if="!result">

        <div class="search">
            <div class="field" >
                <label class="label">Search for a Player</label>
                <div class="control">
                    <input class="input" name="search" type="search" placeholder="Search..." v-model="search"  v-on:keyup.enter="submit">
                </div>
            </div>

        <!-- only call `vm.submit()` when the `key` is `Enter`
        <input v-on:keyup.enter="submit"> -->

            <div class="control">
                <button @click="submit" class="button is-link">Search</button>
            </div>
                
        </div>

    </div>

    <div v-else>
        <div class="result">
            <div class="control" style="margin: 12px 0;">
                <button class="button is-link is-danger" @click="reset">Reset</button>
            </div>

            <h5 class="subtitle" v-if="search"><strong>Rsn: {{ search | capitalize }}</strong></h5>
            
            <div class="skills" v-if="result.skills">
                <h4 class="title">Skills</h4>
                <div class="columns">
                    <div class="column is-4">
                        <div class="columns is-multiline">
                            <div class="column is-12">Total Level {{result.totalLevel}}</div>
                            <div class="column is-12">Total XP {{result.totalxp}}</div>
                            <div class="column is-12">Rank {{result.rank}}</div>
                            <div class="column is-12">Combat {{result.combat}}</div>
                        </div>
                    </div>
                    <div class="column is-8">
                        <div class="columns is-multiline">
                            <div class="column is-2" v-for="skill of result.skills">
                                <p><strong>{{skill.name | capitalize}}:</strong> {{skill.level}}<br>
                                <small>Virtual Level: {{ skill.virtualLevel }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="activities" v-if="result.activities">
                <h4 class="title">Activites</h4>
                <div class="columns is-multiline">
                    <div class="column is-6" v-for="activity of result.activities">
                        <article class="message">
                            <div class="message-header">
                                <p>{{activity.text | capitalize}}</p>
                            </div>
                            <div class="message-body">
                                <p>{{ activity.details }}</p>
                                <cite style="margin-top: 12px;">
                                    {{ activity.date }}
                                </cite>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

        </div>

        <div class="control" style="margin: 12px 0;">
            <button class="button is-link is-danger" @click="reset">Reset</button>
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
    filters: {
        capitalize: function (value) {
            if (!value) return ''
            value = value.toString()
            return value.charAt(0).toUpperCase() + value.slice(1)
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