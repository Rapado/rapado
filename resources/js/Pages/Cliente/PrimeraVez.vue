<template>
    <div class="bg-gradient-to-r from-mauve-dark to-mauve md:h-screen">
        <div class="bg-whiste w-full py-3 px-7 md:px-14 shadow-xl">
            <div class="flex justify-between">
                <application-logo class ="sm:ml-0 md:ml-10"/>
                <div class="flex">

                    <nav-link class="mr-5">
                        <div @click="goHome"  class = "text-white">Registrarme </div>
                    </nav-link>

                    <secondary-button class="text-white">
                        <div @click="goHome" class = "text-white">Iniciar Sesión</div>
                    </secondary-button>
                </div>
            </div>

        </div>
        <div class="md:flex">
            <div class="w-full md:w-2/3">
                <div class=" mt-5 mx-auto w-full md:w-10/12 bg-secondadsry border-gray-200 shadow-2xsl rounded-md">
                    <div class="px-6 sm:py-3 md:py-7">
                        <div class="text-2xl text-white text-opacity-90">
                            <p>
                                Descubre las mejores peluquerías a tu al rededor, evitamos que esperes
                                más de una hora por tu corte de cabello.
                            </p>
                        </div>
                        <div class="text-gray-300 mt-3">
                            <p>
                                Podrás agendar el espacio que más se ajuste a tu tiempo, además de ver las opiones
                                de los clientes cuando quieras probar una nueva peluquería.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-5 mx-auto md:w-10/12 bg-secondadsry border-gray-200 shadow-2xsl rounded-md">
                    <div class="px-6 py-7">
                        <div class="text-xl text-gray-200">
                            <p>
                                Las opiniones de nuestros usuarios
                            </p>
                        </div>
                        <opinion-card class="w-full md:w-2/3"
                            nombre="Juan Fl..."
                            opinion="Me atendieron justo a la hora que hice mi cita. Excelente servicio."
                        />
                        <opinion-card class="w-full md:w-2/3"
                            nombre="Pedro Di..."
                            opinion="Soy nuevo en la ciudad y gracias a esta aplicación pude encontrar un buen barbero."
                        />
                        <opinion-card class="w-full md:w-2/3"
                            nombre="María Pe..."
                            opinion="Mis niños se desesperaban por estar esperando. Ahora los llevo a la hora de su cita."
                        />

                        <secondary-button class="mt-7 w-full md:w-2/3">
                            <div @click="goPeluqueriaHome" class = "text-white">
                               Soy una peluquería, quiero registrarme
                            </div>
                        </secondary-button>
                    </div>
                </div>
            </div>
            <div class = "w-auto pb-2 md:pb-0 ">
                <div class="mt-0 md:mt-7 mx-4 md:mx-2">
                    <img class="h-auto  md:w-full " src="svgs/barbero.svg" alt="peluqero cortando el pelo"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ApplicationLogo from '@/Components/ApplicationLogo'
    import SecondaryButton from '@/Components/ButtonSecondary'
    import NavLink from '@/Components/NavLink'
    import OpinionCard from '@/Components/OpinionCard'

    export default {
        components: {
            ApplicationLogo, SecondaryButton, NavLink, OpinionCard
        },

        methods:{
            goHome: () => window.location = '/',
            goPeluqueriaHome: () => window.location = '/peluqueria'
        }
    }
</script>
