function formataCpf(id) {
    const cpfInput = document.getElementById(id)
    let cpf = cpfInput.value

    if (cpf.length > 11) {
        cpf = cpf.substring(0, 11);
    }
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');


    cpfInput.value = cpf
}

function addInputTelefone(){
    let newDiv = document.createElement('div')
    newDiv.innerHTML=`<label class="form-label" for="telefones[numero][]">Telefone:</label>`
    newDiv.innerHTML+=`<input type="text" class="form-control" name="telefones[numero][]" placeholder="(##) #####-####">`
    newDiv.innerHTML+=`<label class="form-label" for="telefones[descricao][]">Descrição: </label>`
    newDiv.innerHTML+=`<input type="text" class="form-control mb-3" name="telefones[descricao][]" placeholder="Descrição">`
    document.getElementById('telefones-container').appendChild(newDiv)
}
function removeInputTelefone() {
    let telDiv = document.getElementById('telefones-container')
    telDiv.removeChild(telDiv.lastChild)
}
function getEndereco() {
    let cep = document.getElementById('cep')
    let enderecoInput = document.getElementById('endereco')
    let enderecoHdnInput = document.getElementById('endereco-hdn')
    let url= `https://viacep.com.br/ws/${cep.value}/json`
    let data = fetch(url)
        .then(response=>{
            return response.json()

        })
        .then(data=>{
            let endereco = ''
            if(data.logradouro){
                endereco+=data.logradouro+' - '
            }
            if (data.bairro){
                endereco+=data.bairro+' - '
            }
            endereco+=`${data.localidade} - ${data.uf}`

            enderecoInput.value = endereco
            enderecoHdnInput.value = endereco
        })
}
function verificaIdade() {
    const dataNascimentoInput = document.getElementById('dataNascimento')

    let dataNascimento = new Date(dataNascimentoInput.value)
    let divResponsavel = document.getElementById('container-responsavel')
    let idade = calcularIdade(dataNascimento)
    console.log(idade)
    if(idade <= 18 && divResponsavel.children.length === 0){

        let newDiv = document.createElement('div')
        newDiv.innerHTML=`<label for="nome_responsavel" class="form-label">Nome do Responsável</label>
            <input type="text" class="form-control" required name="nome_responsavel">
            <label for="cpf_responsavel" class="form-label" >CPF do responsável</label>
            <input type="text" class="form-control" id="cpf_responsavel" name="cpf_responsavel" required pattern="\\d{3}\\.\\d{3}\\.\\d{3}-\\d{2}" onblur="formataCpf('cpf_responsavel')" placeholder="___.___.___-__">
        `
        divResponsavel.appendChild(newDiv)
    }
    if (idade>12 && divResponsavel.children.length!==0){
        divResponsavel.removeChild(divResponsavel.lastChild)
    }

}

function calcularIdade(dataNascimento) {
    const hoje = new Date();
    const dataNascimentoConvertida = new Date(dataNascimento);

    let idade = hoje.getFullYear() - dataNascimentoConvertida.getFullYear();

    const mesAtual = hoje.getMonth();
    const mesNascimento = dataNascimentoConvertida.getMonth();

    if (mesAtual < mesNascimento || (mesAtual === mesNascimento && hoje.getDate() < dataNascimentoConvertida.getDate())) {
        idade--;
    }
    return idade;
}


