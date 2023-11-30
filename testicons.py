import os
import json
import string
import sys
import pymysql


if getattr(sys, 'frozen', False):
    # Si se está ejecutando como un exe compilado
    directorio_actual = os.path.dirname(sys.executable)
else:
    # Si se está ejecutando como un script de Python
    directorio_actual = os.getcwd()

# Construye la ruta relativa al archivo JSON
ruta_json = directorio_actual + ("\daemon_machine_network.json")

with open(ruta_json, 'r') as f:
    config = json.load(f)

db_host = config['PARAMETROS']['host']
db_port = config['PARAMETROS']['port']
db_name = config['PARAMETROS']['dbname']
db_user = config['PARAMETROS']['user']
db_password = config['PARAMETROS']['password']
db_laboratorio = config['PARAMETROS']['laboratorio']
db_tabla_destino = config['PARAMETROS']['tabla_destino']

# Conexión a la base de datos
try:
    mydb = pymysql.connect(host=db_host,port=db_port,user=db_user,password=db_password,database=db_name)
except:
    print("No es posible conectarse a la base de datos, verifique los datos")
    exit()

def programas_instalados():
        import os
        import string
        import json
        import mysql.connector

        directory_paths = ['C:\\ProgramData\\Microsoft\\Windows\\Start Menu\\Programs','C:\\Program Files (x86)','C:\\Program Files']  # Lista de directorios que deseas buscar
        allcarpetas = []

        try:
            for path in directory_paths:
                # Lista todos los archivos y carpetas en la ubicación especificada
                for carpeta in os.listdir(path):
                    allcarpetas.append(carpeta)
        except Exception as e:
            print("Error:", e)

        tabla_de_traduccion = str.maketrans('', '', string.whitespace + string.punctuation)

        allcarpetas_limpio = [carpetas.translate(tabla_de_traduccion) for carpetas in allcarpetas]
        print(f"<br>PROGRAMAS PC = {allcarpetas_limpio}<br><br>")

        mycursorsoftware = mydb.cursor()
        mycursorsoftware.execute("SELECT programs FROM software")
        registro = mycursorsoftware.fetchall()
        registro_tupla = [str(x) for x in registro]

        # Definir una tabla de traducción para eliminar espacios y caracteres especiales
        tabla_de_traduccion = str.maketrans('', '', string.whitespace + string.punctuation)

        # Eliminar espacios y caracteres especiales de cada elemento en la lista carpetasfiltradas
        resultado_limpio_db = [carpetas.translate(tabla_de_traduccion) for carpetas in registro_tupla]
        print(f"<br>BASE DE DATOS = {resultado_limpio_db}<br>\n")

        try:
            carpetasfiltradas = list(filter(lambda filtro: any(palabra in filtro for palabra in resultado_limpio_db), allcarpetas_limpio))
            carpetasfiltradas_json = json.dumps(carpetasfiltradas)
            print(f"<br>FILTRADAS = {carpetasfiltradas}<br>\n")

            # Crear una lista con las carpetas no filtradas
            carpetas_no_filtradas = [palabra for palabra in resultado_limpio_db if not any(palabra in filtro for filtro in allcarpetas_limpio)]
            print(f"<br>NO ENCONTRADAS EN LA PC = {carpetas_no_filtradas}<br>\n")   

        except Exception as e:
            print("Error:", e)

        mycursorapps = mydb.cursor()

        # Utiliza una instrucción SQL de inserción para agregar cada ruta a la tabla
        sql = "UPDATE workstations SET software = %s WHERE mac = '80:c1:6e:f1:d8:4d';"
        val = carpetasfiltradas_json
        mycursorapps.execute(sql, val)

        # Confirmar los cambios en la base de datos
        mydb.commit()

        mycursorapps_out = mydb.cursor()
        # Iterar a través de la lista y realizar inserciones
        for ruta in carpetas_no_filtradas:
            # Utiliza una instrucción SQL de inserción para agregar cada ruta a la tabla
            sql = "UPDATE workstations SET software_out = %s;"
            val = (ruta,)
            mycursorapps_out.execute(sql, val)

        # Confirmar los cambios en la base de datos
        mydb.commit()

        # Cerrar la conexión
        mydb.close()


programas_instalados()

