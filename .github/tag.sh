cat ./readme.txt | while read line
do
    if [[ "$line" == *"Stable tag:"* ]]; then
        tag=$( echo "$line" | cut -d ':' -f 2 )
        echo $tag
        exit;
    fi
done
