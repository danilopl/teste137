<template>
  <div class="profile-single">
    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            {{ profile.name }}
          </h1>
          <h2 class="subtitle ">
            <strong>E-mail:</strong> {{ profile.email }}<br>
            <strong v-if="profile.administrador == 1" >Administrador</strong>
          </h2>
        </div>
      </div>
    </section>
    <section class="profile-content" v-if="profile.administrador == 1">
      <div class="imagens">
        <div class="container">
          <div class="imagens-images columns is-multiline has-text-centered">
            <div v-for="imagem in profile.images" :key="imagem.id" class="column is-one-third">
              <router-link :to="'/imagem/' + imagem.id">
                <Imagem :imagem="imagem" />
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Imagem from '@/components/Imagem';

export default {
  name: 'Profile',
  components : {
    Imagem
  },
  data () {
    return {
      profiles: [
        {
          id: 1,
          name: "Danilo Pereira de Lima",
          email: "email@cni.administrador.com",
          administrador: 1,
          created_at: "2021-02-07T01:32:43.000000Z",
          updated_at: "2021-02-07T01:32:43.000000Z",
          images: [
              {
                id: 1,
                path: "https://viagemeturismo.abril.com.br/wp-content/uploads/2016/10/1005126_10152964189530704_1382375584_n-e1482354487792.jpeg?quality=70&strip=info&w=698",
                user_id: "1",
                name: "Congresso Nacional",
                created_at: "2021-02-07T01:33:16.000000Z",
                updated_at: "2021-02-07T01:33:16.000000Z"
              },
              {
                id: 2,
                path: "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAPDxAPDw8VFRUVEBYVFRUVFRYXEBUVFhYXFhUXFRUYHSggGBomHhUVITEhJSktLy4uFyAzODMsNygtLisBCgoKDg0OGhAQFy0dHx0tKy0tLSstLS0tLSstLS0tLS0tLS0tLSstLS0tLSstLS0tLS0tLS0tLSstLS0tLS0tLf/AABEIALcBEwMBIgACEQEDEQH/xAAcAAACAgMBAQAAAAAAAAAAAAAAAQIGBAUHAwj/xABKEAABAwIEAwUEBgYGCAcAAAABAAIDBBEFEiExBkFhEyIyUXEHgZGhFCNCUmJyM4KSscHwFTRTorKzJENzdIPT4fFEY2STo8PR/8QAGAEBAQEBAQAAAAAAAAAAAAAAAAECAwT/xAAhEQEBAQACAgIDAQEAAAAAAAAAARECIQMSMUETUWEiQv/aAAwDAQACEQMRAD8A5UmEWTXqcQFIuSRZUF0k7J2QJFk00CQnZFkCspAIQgkSkhO6AQ5BKSBWRlUgvbsnAEEdCNiDexBB2KDHskpuaRa/MXHUeY6JIIWTTRZAkwkmik5RUrJEKCNkrKSERFJSSRUUKSSCKSkkoqKFJCD0TQmtMhNCaBWQmmgSLJ2QgLIsnZOyCKFKyLIEhOyLICylE7K4EtDrHZ18p9cpB+BSsiyDKNWw/wDhofjP/wA1bJ2IxEMvA1xb9omXUbAAPe42HK59wWjspNGh9yzeMrUrNqK2MuJdAyQndznVAd6O+t3GyxquZj7ZIWx23yukN/XtHO+XmvGyFcTUbJWU0rKojZFlKyEUsqiQpkqJUEbJWUkIIIUiEkEUlJIhBFFk0KKihOyEHomhNVkJoTVCTQmgSaE0BZFk00EbJ2TsnZBGydlmtw2U05qg36sS9kXAi7X5cwBG4BGx20K33GWEsaykr6dgbDVQtJa0WZHOwZZWADYXBI/W8lNi40UOFSvppapoBjikYx+veaZL5Tb7txa/msGyvvssibUOrsPk8NRSHXydG4ZSOozk/qql1dM+KR8Ugs5jy1w8nNNiPiFJe8MbLD8AM1BV1of/AFd8TclvEJDYnNfS2nJaYDQrp/s1ofpGE4tCN3jKPzdk4t+dlzB24/nkpLtq43nB/Dv9ITyRF5Y1kD5S4C/hsALX5khaGy6r7IKK1LiVT+Dsh+qxz3f4mfBctsrLtpZ0yMLwuWqkMcDMzgxzzqAA1gzOJJ0AsFh2XQeF6L6LguJYg4d6WP6NF55XODHkernf/GqdhGGyVdRFTxDvyPDR5DzcegAJPQJL8mNfZJWjifCmOr5qagiu2njyuIOruxb9dK8k2vmzX9FWSFZdTEElJJBFCkkgikpJIIpFSSRUUlJJQJCEIPRSSTVZNCE0AmhNAk0JqgTQmgEBCYUF49mHZTyVWGz+Cqgs3pLFdzSOtsx/VVn4WwN1Th+IYNUC0lPPeNx2aXgujcOhLXH0eVy/Bq91NUQ1DPFHI1462Oo9CLj3r6IhhjdUQ18J7s9OI3+Tmm0kLj1F3N/4i4+TqunFxLgeV1Hi9O2QFpE5heDyL7xEH0cR8FtvbDg3Y1ralo7tQ258hIyzXfEZT8VbOM+CnS4hDXwPhjAc18xldlbmjc0hw0NyQLH8oW949wqnq6MtqZTGxsjXiRrC9zTfLoADoc1vep79ynr1is+xD+q1Z/8AUN/wD/8AVyjiGk+j1k8GwjnkaB+EOIb8rLuPs9wylpYahlJNJKDKC8yNykOyjQaDSyrfFmB4S6sqJKoVQkJDn9mWdnqxoBaDrsPjdSc5tq503HANL2GAlxFjJFPMfeHBp/ZY1cTo6d0skcUYu57msaPNziAB8Svo/wChRQ0Bgu5sTKQsJ0MjYxHYnTQuAufVU7g7gqgiq46iCrllMQzCOSIttmBDXF2UDmSPRXjzzaWMb2psbRYZQ4fGdMwv+IRN7xPq+QFeHs1wxtFR1OMTt2if2IP3W7n9ZwDR0HVb3j3g+pxOspnMezsI2tZIM31zczy57g21vDltry2VixrBWzRU1E1obAHtMjRsYobFsfvf2fua5PbrDO3K6imdQYM+aX+s4i+xv4mweN/7Wl/zjyVAKvXtaxbt8QMLT3KdgiA5Zz3pPnZv6ioxXXj8MVApKRCRWkRSUkiiopKSSCJCRCkkoIpKSSKihNCgmE0JrTIUkkwgaEJoBNJNA0ITQCYSUggk1d39lGJGowwRX78D3R3OvdPfjPoM1v1Vwlq6h7Dqm01ZDfxRMeB+Rxaf8wLn5Jsa4/K6+0HDxNRmQDvQO7UfkAIkH7JJ9WhZEEYq8OYxx/S0oaT1LMpI9+q3c8Yc1zXC4III8wRYhafhylMFHDA7Uxh0d+ZyPc0H32uvO203s3B+jzlwse0bmHk4MbmHxutdxpRF2I0oAuJmxMdrsBNZxtz7r/krPw7h5gNdcWa+rc9nVr2RuNumZzh7l5Y3QGSqw+YDSOWTN6OZp/ea1PojPx4f6HVf7tL/AJblq+DImmJ84Fu0lIbffJFeMf3g8+9bfGYy+lqWNFy6nkAA3JLHAALzwWl7Cngh+5G1p6mwzH3m6qtDgFP9Ixasqj4YXGMf7SwZ8mMv/wAQK0YrWCmhmqH+GONz+tmtJt7ytdwfS9nS5z4ppZJ3de0eS3+5kHuWp9rdb2WFSNBsZZI4/nnI+DCrIOE1c7pHvkebue9znHzc4kk/EleBCkVEr0uSJSKkVEoEkmkgVkrKSRU1cRSKaRQRKEykikhCFBMJqITWmUk0gmEDCaSEEkLHLpO0yNaNbWu4AkkXHPQdVkvaWktNrgkaG4000PNScpfgwJqN0wqJJhJMIJBdC9il/wCkZf8AdH3/APciXPWrrXsQw0gVVW4aWbE0+nff/wDWsc70s+XUXDVY9Q7Wyk+YNa57tmguPoBcrVz1Za0Ofo4gadba+4LzWukbRju4Vh1klsv5r/BarhPFjVUjpifFUShv5GvIYR0LQD71ruJMTcypomNPddK7Nr9nJkF/PvyRpvSyLkx4+S8i7mtbhlbclhOoGnosXh7E/pFJDKTcllnfnaS13zBVlMWTS2my537b3H6FTeX0of5Ulv4q60VSXtc07tdb1BALT87e4qse1ShM+FvcBcwSNl9wux3wa8n3LXG9pY4WgppFelzRKSZSUCSTKSBJEJpIpJFNIqCJSUiolAkIQgYTSCYVRIJhIJhENJ7w0XJsEOcACTsFpayoMjtNhsP4+qzy5YsjbYJXhk8xc1zg5hDbOsNg3XzbbcdF7he3DHDdQ49o9oYxzSAZGAk32Lc3h8r76ryc2xI8iR8Fnx2bV5BMJLMwmCGWojilA2e4lxs0NABOh0JADjr5LfLl6zUkYoUgvSqc10jyxoa3McoGwby+Sz+H8DnrphBTszOOpJ0Yxv3nu5D+RdN6MS4dwSauqGU8A7ztST4WNHie7oPnoOa+g8Mw+Kjp4qSDwRixPNzt3OPUm5WBwvw/DhkHYw957rGWUiznnyHk0ch/EkrOq6sRt11PIfx9Fw589akRxOtYxlnHS4NhuSNWtHvAPoOqonE+NPe0xMdZ8ruyYb6NzaG3oLk+i98driXEZteZOzRz9CqNVUj6p4nfI2KBrSWFzm5i3W7w0nc5TboAuWa1eo6PwXIPorwwWYJ5AwDSzGnI35NWn4oqiZpi1t+wpWSDQXuJmyH00jb8VvuD6IxYbT5h3nsDj6u/k/Fc9qOIQK2ocWB7HylltLlrcrBYkHTuX95SS2rbkdBoKodpG8HR1vg4afvC1uB1RheYCLNfd7DyD4wIpWj3tD/1itbwrV9rSxG+rAWHzuw5f4LScR1FSyqcIiA1komZ4R3pBmdrvYlzwrJ9Lb9un0dVZ1zpcWPu2/efiVsyGva5rgHNc0tc07OaRYjroVWMBr21cTZmacnN+0x48TT/AD5FbuJ5bvt5+SSq4rxlw0/Dqgs1MTyTC/zb90n7zb2PnoearxX0Ti9BBWwugqG3adiPE13JzTycP+i4fxbw7NhshEoLoyTkla0lrh1A8LhzB+a9HHnvy53i0hQmkts4SiVIpFFRQgpIBJNJQRKSkVEopIQhAgmFEFSCrKQTUQpIjJoZmMeHSQtlZqHRvuGuB6jUHqFv8SxSGCnFVQYfCwA5S8WfLERlzZ2OBDTq20guDcA2JAVYW0wqsEUNS5zbgMa6xAcN8jmlpIzAtebi40C5eTjLNalWbh2aOVs1y6WKFz3B8shc9zurbAWGXQC46qjt2Vj4dqGsw2afQd0sa0OvqXDLdu4NySb38V1XQp4vsqQU8KwZ9S6SZrwMkjY23+0SbEdO7cr0oKR80scUbS5z3AAAEnXnYa2G56BZWF1f0bs6SRoDvpxEp1BAc3I2+mtnEnMD+8K+W36OKycJ+z+orXF8n1MDXkGQjvPsbERNPi28W3rsuv4Vh1PRRCCljDG7nm952zPd9oqWI4jHBG3O8NaAGt8zYaBoGpOnJVKqxyapeY4AWNDSSb/WZRzcR4B0GvXkuXLnasjTTcSVj8fMEErjE15a6M/oQ1sXeLrA2GfnuTYX1Cs2K1WQEl13ndx5Dzty6D+TxXhjG3UdaKkd7OS1+YnVsjhd3qCA73dVZMS4kbOT2ocY7mzAcpf1kPl+H4+SmLLj2rqyOrLohKWRbPeG3fL0Z+Hrz9F6x8N08piiYZnvklZEC/RoBPeOhvYAO0/CsSi4myAmOmibpYGwJB+Hqrx7PHS1dXJUTeCBmVlgA3tHixIAA2bf9tXuGyrHxbOaajf2I7+TsoWjcvIyssOm/oCuWNwWzmAsY0Zmt72nKPzued1ZfaRixkqRFG45YBrY2vK9pB15ZW6frFUqpPeaTqe01va+zd1JFqyYJTtpKnsC9hbMwPaGHwysFnNPqLHbkVvqnDoXTMkmsGmPLcmzczCXNB1G4c79lUFzw1oLIx2jMjmPzWIIL9LDQjS3oV0GkkZiFHmb9tgc0cw9pva/LUW+KWYrRVGMw0VR2lNYh1u0Y0dx7Rpob2DxyPu9LzhmIRVMQlhcHNcPeDzDhyPRc3rcMppQPo9QGut4JQWnyIBy7rDw+qqcPlzsBFz3mm5ikA5H+BGo/frE3HUqqf6P3n/oj9vkw/j8h+Lbztpeqcb1LKmkrC67fobmljs2j3OFrDT0t8L6q08P41BXRnJo61pInWzC+mo5tOuv/ZUDjrBnwCphaMtLI1jmi/dD4zmaCb3De+dNPANdFktVNuCunpW1lNJ24bGz6SwC08EmXvZ2bllwbOHL0utMr57MKkw4vUQltjNSRvc0Oa7JIwAlpLNAe88/DzVp4u9nsNXmmpMsU2pLdoZD1A8Duo08xzXbjz/aY4yolZmI4fLTSOhnjcx7d2u36EHYjqNFiELoiKSZQoqKE7JIYSRTKRUMRQmhB5hSCGhTAWmCCYTDVLKgQWY1jvodY5vJsYPpdxP7lhveGi5U5MQLacxt2mzsNwNx2WX/ABO+KxzvWLIycOqMuHMjbpmmJcbakAefS4W74T4NqsRN4xkiBs6Z4OQeYaPtu6D3kKweyvg6nrKVlXVXLGySBkOzXHMDmcRqW2sLC3h18l0vEcXipwImNF2tGWKMAWbyvyY31t0XP2nGLe3nw7w7SYYy0LbvI78rrGR3qfst6DRch4wp4pK97aWie+V1nySveexALrMdHYWAIb4tdtASCrZjmPl9+0dcf2bb9mPzG3f9+nRc+xSaVtfG98xEckrLNzkNY57Ga5b8xbW3msbb2LoZaqpkEZcx8x1e9ucsiYeRLmjboAD63W7mqKfD4WxlxJe4NvvLI86Xt5C/oAtPieO0+Gw9lCM8rmh1tASSPHJbYdP+pVNo6588/bTuzEvbdx0AbmuQ0cmgcv5L161pqYsLc2vNMCDlcbFxFi22ZhPW2U2VwhwSjgBkrJs3k0WGb8rQ65H8+lSNblq3mnkdJdrrvdbOA6xc7MAAdSW7DfyW3wTCnVbjJLIct7El3eJ3I1Og1+fVb+mKHvEk730rMrWm7QOQtudTrYXJ9ei7Bw1bDMH+kSiz3NMzhzL3+Bn+EKqYdhDXPgpYhlEj7OHMxtsZCdTe4AafzWVq4plbPVQ0Q/RxZXyjzc64ibuNmhzveFnlV4udS1Je17nO7ziXOdfQvcHkk6+Z+YWvlBu2/JwOtydhr8ltMcw/siOyuWaE63yktJsbE3tfdeDhqB77eXdWJcdPl5Ws65O+lrm9s2vPqtp7PsR7CpfSO0a8l0eugcPEN+YF/cV4vp2l9/xcjvYjbVeUmEyPdeA2ex4e0nkQ7S5Hmte0vSXpkcd4b2NU57W92UZxYaa6PH7Wv6y0VBiMkJt4m82nUfPbddGxRgxLDGzsH1kYLi3mC3uzMPz/AGQqFNhMrBd0TxrvlNvjZbl6St9hr4ZCyaE9nILkOZ3XNPMFoFiOh0P7sjj/AIhL8KljmGSa7MhDSWSknKCy47rhe9txa4JVR7ItN9QfgvWbtJouyzus10bzvlyiRmb5EqWJ9Pbg7B5aeg/pBkVgXZQ9hf2gY3/WWLtMztdLWvtZXnA+Mw6zZ9R/aNHeH52D94+HNeHBWO01LE2mcfqXF1pb3jzE2LXA7Ntlsfj5rF4w4SNMTV0f6LxPY3/V/ibrrH+702jXH4W/GMJpMShDZmh7bXZIwjO2/Njx+7YrkHFvBNRh95P0sF9JWjbyEjfsHrt15LcYPj0sDu6+1zqN43fmbffqLFdAwTiOKoGR1mudpkcQ5j78mnZ3obHotceWLY+fiErLrnFvs0ZLmmw6zHbmAm0Z/wBm77J/CdPRctqKV8T3RyMLHtNnNcLOB6grpqSMYMSyLf4Dgj6p7WRi5vtzXrxBw5LSOySNsbak7eg81y/Nx9vXXX8VzVYIUSFkPYvItXTXPHnZCnlQmmJ9gQveOlJB0W0FJZ+Ud439yuuC8CTSOs9pbdl7HQi409yt5OLm74couVi9oPOy6DxJwxkn7GGNxucrG7vPrZZeA+zpjHtkrWmV51bTM8F//OkG4/C3TzO4WbzxcUnhbgypxEl8ZyQNJz1EmkTfMN++7oPeQvD2g0ENJUw0lM5zmRRA53eJz3uJc63LwtsPKy7dVVccTW58jiwWZG3SkhA2DWiweR006hcH47ru2xGoedw8AnzsATpy1JXOXarrnC9TLHhdLGwdm0RauHjcSSTbk311PotPitXJq2NjrbkgE3PmSRcnqVq8J4oApqYP1axlsptqATvqt/Ve0mJ7GQQQxQBxyue++Vt/IjnusSXe28iqU9NLUyZG6AeN5HdYCbXP8BzXrUUTZcTponsNmSyEX0LoYmmwFtr2HxWFxNxUHRvhpyRHfvPvlkld6/ZHXf8AjmjiWGHGY6jK9wihLAwtc3M+4t4hp1Nrd1dPmOdncI8JT3dLUMy5yXZbEC5O2o2GwHkAPROwwPZJGHZfqJSSNbZI3P2vzy29/op45xhNVPzOLQLWAGW1vLZY2CYvHFNG+YjICQ/Y9xzS12gF9iVn/VdOmp4EwWaqqHiIZmti7xAP2iAwW05g/BWr6DU4U8mSNxicQbi4t5WJB139bXXp7J+IqfDBWRSNEgPZZHtLe83K5zRr0fr5G4Xvxf7SW1PaQspe5bxGwdte+a4sdtvJPays2bFi4Yr4YY6rFpL9lFFlaQNTbvSZdBe5yt9WLw4eqS8S1rjd0pbIXC+jnte8BumoDcjRquc41xkyowptBCwxCMNc4l4c6Yg62AAtd3eO68KLiSsNNGwOJFrkgMv3QWi7jvoLq5qfDp8LM7hc30Avrl/RnfvdT7lgYrRQsdo4N27pcMwPZjlmvbkuef0jKIDM8PMVxvI07tAHcvfYjWy2dRTVLHX7Fu9tJ4Dyvyd5K+k/ae1i3zdi3Me0B31ANvC3azlnDEaaJgyOJOpd3Hgl1w7W49R6Kl4ZJUTVDaUQjMe9Z00IbawBOYm3MadUYtiJopezqIg0m9iHxua4AAXBY7qPinpxnwnvyvVi68OY1FDWmJp+qqCTYiwbKOXo5oHvC9cXrm0kroCxxtq090AsOrNTubWv1BC5nWcVxaBsdyCHBzZPC5uxGnmFZpOLhiMcTxRTN7JjhJOQDTho1sXDbvXH6wCmN/TPxXjVkTWulhOpyg57305gMvy81gU/GEVY51O1uj43gjW4s0nctA3sq9xjUslpIZIyC0y6am57rxsfRafhOuBrYjKQG2c1xA2aWnMeq3kZ+m64DxGWOlewNzAPc8Bw0LTZrvgW/NXXhri99MRG9l4TuwG7o+sdzq38Hw8lTeCsTa0z0uh/0V9jyz5i7T4/uWWakt1y7eqkmmrNxZw+zs/p2HkPgcC57G3PZ+ZaPu+bd2+m1Wo61zDfxDmDsfXVb3COK6WAEDNHPlLrC5glAsO+21geWbQ7b7LDxOmiqAaqhbYjWan0zsJ+3H5t6D3eQ3y4SfenDyXl9YsmBcZllmSXcPJxu4fked/R3xCsGM4XRYvDdwJc0aSRi1TF0Ld3N/Cd+Xmqfw7LG6MwTwxtfIRke9pe423sGX87LIpsaggvaIXZcCSOQxOA5kEgtLdNiNVi9XHSXVdqKCrwWVsxcHw5u5URi7HOvoH82G+7T8TqtriHEVPXUsj6hrhPma1riRlsRewG9tCrJFjLJ2tMv1TpWaSFodBO0d208R0eOWZv90aKs1eAxQzNtEGZ3B/YufenmAvrSznl3vA7UaWPJeby+Lf9T6enxeT/AJqi1bQ0nQ/Bebo22vY/KyvWNYXFXyymhiLOxZ9ZHIcsjTzAaddztZa7tWwUstJNStMpykPIIkaNB71J5rZ03fFNVA5PxfJCyjTH7jvc02SW/wAv9Y9P4lT4oQ/NmO/mr7gXHNSCLZpHEAWAJIaFyBk1tVtcK4lqKUkwTPjzb5HEXtte2/Nd68WLFxPjk8khMuZj7a3u0kHoqbUVLiT3j8Sp4pi0tQ8yTSOe77ziXO+JWudJdFkxMSgOBLbgEEjzA5LzqZ3SPe927nFx9SbqBci/RUZFM/MWte6zQN7bDyG38lTnjDTo645HY6jyuVihyebooqTui3uC8N1uI9pJE0vy+Jxc0a+8haEP6L3iq3NBANrpf4PaoidEXwyNBIfYnQuBG4DljkX2JHooulv1SDigsHDkNAA91ZLOxw8HZNYQfUuI5rWzSDM4tBsb6nS46hYzHW5KeZTA42Nbfu3v5o7OP+zHzSBRdUT7OP8Asx815zQs0IYNNxY2KndF0AxsR2jHzUgGD7A/n3rGd3Tcafu9FNjwUHq5jCb2t6aLbF1CKQNEUn0jMbuL29jl5d3Le/vWlN09UEnEfd+C8nnQNaQ219R4je253/7ppEIPOMvYSWOsS0tNubTuFPMeZPxSsi5QbfABSukP0ueWNuU2dE0PdfyILhosOeqLJHGKoksCcrszmvIvpex02Gl1iZ1HOEVmDEqjT/SZdNvrX6emunJElbO4FrpnkEWILiQR1BKwsvQJ5P5ug2hxaqIa01EhDRZoJJDR5DyCyRxFW9mYjVvLCblrrEX8wHDQ9RqtILjmpdo63L4LONxvoOI6kPjeZsxZYAkNzWGzb2uR5A7cl6cS8Uz18pmmIzloFwLaDlZVt0n4fgol/nf5pIWtmzGqhoDWvAAAA7jdgLbkaoWruPvITE2/t53UsyELbBEpIQgSLIQgaE0IIlIXJ3SQoPYNTskhUSCYQhA0IQgFJCEEJRoVjx76IQoMlCEKhXQhCASQhFIlRKaER5Ob5IDyN0IUEy4hAkKEKmjOlmTQhqN+iEIQf//Z",
                user_id: "1",
                name: "Catedral",
                created_at: "2021-02-07T01:33:16.000000Z",
                updated_at: "2021-02-07T01:33:16.000000Z"
              },
              {
                id: 3,
                path: "https://cdn.pixabay.com/photo/2012/11/21/17/02/lion-66898_960_720.jpg",
                user_id: "1",
                name: "Leão",
                created_at: "2021-02-07T01:33:16.000000Z",
                updated_at: "2021-02-07T01:33:16.000000Z"
              }
          ]
        },
        {
          id: 2,
          name: "Cristiane Alves de Lima",
          email: "email@cni.usuario.com",
          administrador: 0,
          created_at: "2021-02-08T01:32:43.000000Z",
          updated_at: "2021-02-08T01:32:43.000000Z",
          images: []
        }
      ],
      profile: {}
    }    
  },
  created() {
    this.profile = this.profiles.find(profile => profile.id === Number(this.$route.params.id));
  },
  updated: function () {
    this.$nextTick(function () {
      this.profile = this.profiles.find(profile => profile.id === Number(this.$route.params.id));  
    })
  }
}
</script>