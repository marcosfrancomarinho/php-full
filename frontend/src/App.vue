<script setup lang="ts">
import Footer from "./components/Footer.vue";
import Header from "./components/Header.vue";
import { onMounted, ref } from 'vue';

type Users = { user_id: number; name: string; age: number; };
const users = ref<Users[]>([]);

async function searchAPI(): Promise<void> {
  try {
    const response = await fetch("http://localhost:8080");
    const rawResponse = await response.json();
    if (!response.ok) throw new Error(rawResponse.error);
    users.value = rawResponse;
  } catch (exception) {
    console.log(exception);
  }
}

async function registerUser(e: any): Promise<void> {
  e.preventDefault();
  const form = e.currentTarget as HTMLFormElement;
  const formData = new FormData(form);
  const { name, age } = Object.fromEntries(formData.entries()) as { name: string; age: string; };

  try {
    const response = await fetch("http://localhost:8080", {
      method: 'POST',
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ name, age: Number(age) })
    });
    const rawResponse = await response.json();
    if (!response.ok) throw new Error(rawResponse.error);
    users.value.push({ user_id: rawResponse.userId, name, age: Number(age) });
    form.reset();
  } catch (error) {
    console.log(error);
  }
}

onMounted(() => {
  searchAPI();
});
</script>

<template>
  <div id="container">
    <Header />
    <main class="container my-5">
      <h1 class="mb-4 text-center">Cadastro de Usuários</h1>

      <form @submit="registerUser" class="mb-5">
        <div class="mb-3">
          <label for="name" class="form-label">Nome:</label>
          <input type="text" name="name" id="name" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="age" class="form-label">Idade:</label>
          <input type="number" name="age" id="age" class="form-control" required min="0" />
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </form>

      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="({ age, name, user_id }) in users" :key="user_id">
            <td>{{ user_id }}</td>
            <td>{{ name }}</td>
            <td>{{ age }}</td>
          </tr>
        </tbody>
      </table>
    </main>

    <Footer />
  </div>
</template>

<style>
#container {
  display: flex;
  min-height: 100vh;
  flex-direction: column;
}

main {
  flex-grow: 1;
}
</style>
