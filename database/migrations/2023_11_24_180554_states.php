<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    const  states = '[{"id":11,"acronym":"RO","name":"Rondônia"},{"id":12,"acronym":"AC","name":"Acre"},{"id":13,"acronym":"AM","name":"Amazonas"},{"id":14,"acronym":"RR","name":"Roraima"},{"id":15,"acronym":"PA","name":"Pará"},{"id":16,"acronym":"AP","name":"Amapá"},{"id":17,"acronym":"TO","name":"Tocantins"},{"id":21,"acronym":"MA","name":"Maranhão"},{"id":22,"acronym":"PI","name":"Piauí"},{"id":23,"acronym":"CE","name":"Ceará"},{"id":24,"acronym":"RN","name":"Rio Grande do Norte"},{"id":25,"acronym":"PB","name":"Paraíba"},{"id":26,"acronym":"PE","name":"Pernambuco"},{"id":27,"acronym":"AL","name":"Alagoas"},{"id":28,"acronym":"SE","name":"Sergipe"},{"id":29,"acronym":"BA","name":"Bahia"},{"id":31,"acronym":"MG","name":"Minas Gerais"},{"id":32,"acronym":"ES","name":"Espírito Santo"},{"id":33,"acronym":"RJ","name":"Rio de Janeiro"},{"id":35,"acronym":"SP","name":"São Paulo"},{"id":41,"acronym":"PR","name":"Paraná"},{"id":42,"acronym":"SC","name":"Santa Catarina"},{"id":43,"acronym":"RS","name":"Rio Grande do Sul"},{"id":50,"acronym":"MS","name":"Mato Grosso do Sul"},{"id":51,"acronym":"MT","name":"Mato Grosso"},{"id":52,"acronym":"GO","name":"Goiás"},{"id":53,"acronym":"DF","name":"Distrito Federal"}]';
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('acronym', 2);
            $table->string('name', 100);
        });

        $states = array_map(fn($s) => (array)$s, json_decode(self::states));
        \App\Models\State::query()->insert($states);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
