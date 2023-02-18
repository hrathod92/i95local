#!/bin/bash

if [ $# -eq 0 ]
  then
    echo "Usage: bash make_demo.sh ModuleSingular module_singular"
    exit 0
fi

CAMEL=$1
UNDER=$2

MODELFILE=$CAMEL
MODELFILE+=".php"

CONTROLLERFILE=$CAMEL
CONTROLLERFILE+="Controller.php"

TABLE=$UNDER
TABLE+='s'

SEEDERFILE=$CAMEL
SEEDERFILE+='TableSeeder.php'

cp 'Demo.php' $MODELFILE
sed -i -e "s/Demo/$CAMEL/g" $MODELFILE
sed -i -e "s/demos/$TABLE/g" $MODELFILE

cp 'DemoController.php' $CONTROLLERFILE
sed -i -e "s/Demo/$CAMEL/g" $CONTROLLERFILE
sed -i -e "s/demo/$UNDER/g" $CONTROLLERFILE

cp 'DemoTableSeeder.php' $SEEDERFILE
sed -i -e "s/Demo/$CAMEL/g" $SEEDERFILE
sed -i -e "s/demo/$UNDER/g" $SEEDERFILE

rm -r $UNDER
cp -r 'demo' $UNDER

sed -i -e "s/Demo/$CAMEL/g" "$UNDER/index.blade.php"
sed -i -e "s/demo/$UNDER/g" "$UNDER/index.blade.php"

sed -i -e "s/Demo/$CAMEL/g" "$UNDER/show.blade.php"
sed -i -e "s/demo/$UNDER/g" "$UNDER/show.blade.php"

sed -i -e "s/Demo/$CAMEL/g" "$UNDER/edit.blade.php"
sed -i -e "s/demo/$UNDER/g" "$UNDER/edit.blade.php"

sed -i -e "s/Demo/$CAMEL/g" "$UNDER/create.blade.php"
sed -i -e "s/demo/$UNDER/g" "$UNDER/create.blade.php"

mv $SEEDERFILE ../database/seeds/
mv $MODELFILE ../app/
mv $CONTROLLERFILE ../app/Http/Controllers/
mv $UNDER ../resources/views/
