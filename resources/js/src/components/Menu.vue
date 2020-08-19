<template>
  <div>
    <b-navbar toggleable="lg" variant="light" type='light' class="personal_bg">
      <b-navbar-brand href="#"></b-navbar-brand>
      <img width="30" height="30" src=".././assets/logotipo-branco.png" />
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-2">
          <b-nav-item :to="{name: 'home'}">Pagina Inicial</b-nav-item>
          <b-nav-item :to="{name: 'loja'}">Lojas</b-nav-item>
          <b-nav-item :to="{name: 'produto'}">Produtos</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>

<style scoped>
.personal_bg {
  background: rgb(250, 237, 12);
  background: -moz-linear-gradient(
    90deg,
    rgba(250, 237, 12, 1) 0%,
    rgba(217, 181, 20, 1) 0%,
    rgba(255, 124, 0, 1) 100%
  );
  background: -webkit-linear-gradient(
    90deg,
    rgba(250, 237, 12, 1) 0%,
    rgba(217, 181, 20, 1) 0%,
    rgba(255, 124, 0, 1) 100%
  );
  background: linear-gradient(
    90deg,
    rgba(250, 237, 12, 1) 0%,
    rgba(217, 181, 20, 1) 0%,
    rgba(255, 124, 0, 1) 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#faed0c",endColorstr="#ff7c00",GradientType=1);
}

.bg-light {
  box-shadow: 1px 1px 1px 1px;
  border-bottom: 1px solid #333;
}
</style>
